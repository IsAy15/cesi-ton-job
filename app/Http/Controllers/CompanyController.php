<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Grade;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::where('status', '!=', 'hidden')->paginate(5);


        foreach ($companies as $company) {
            $grades = Grade::where('company_id', $company->id)->pluck('value');

            $averageGrade = $grades->avg();

            $company->averageGrade = round($averageGrade, 1);

        }

        return view('companies.index', compact('companies'));
    }


    public function create(Request $request)
    {
        $create_offer = $request->has('offer');

        $user = auth()->user();

        if ($user->role === 'user') {
            return redirect()->route('companies.index');
        }

        return view('companies.create', compact('create_offer'));
    }


    public function store(Request $request)
    {
        $company = new Company();
        $company->name = $request->input('cp_name');
        $company->sector = $request->input('cp_sector');
        $company->localization = $request->input('selectedCommunes');
        $company->save();

        if ($request->has('create_offer')) {
            return redirect()->route('offers.create')->with('company', $company->id);
        } else {
            return redirect()->route('companies.index');
        }
    }


    public function edit($id)
    {
        $user = auth()->user();
        if ($user->role === 'user') {
            return redirect()->route('companies.index');
        }

        $company = Company::find($id);

        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->name = $request->input('cp_name');
        $company->sector = $request->input('cp_sector');
        $company->localization = $request->input('selectedCommunes');
        $company->save();
        return redirect()->route('companies.index');
    }

    public function destroy($id)
    {
        $user = auth()->user();

      if ($user->role === 'user') {
        return redirect()->route('companies.index');
    }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Offer::where('company_id', $id)->delete();

        Company::destroy($id);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return redirect()->route('companies.index');
    }

    public function data($id)
    {
        $company = Company::findOrFail($id);
        $totalApplications = $company->offers()->sum('applies_count');
        $offers = $company->offers()->get();
    
        $grades = Grade::where('company_id', $company->id)->pluck('value');
        $averageGrade = $grades->avg();
        $company->averageGrade = round($averageGrade, 1);
    
        // Assurez-vous que $company->localization est défini avant de le décodé en JSON
        $localizations = [];
        if ($company->localization) {
            $localizations = json_decode($company->localization);
        }
    
        return view('companies.data', compact('company', 'totalApplications', 'offers', 'localizations'));
    }
    
    public function rate(Request $request)
    {
        $userId = auth()->id();
        $companyId = $request->input('company_id');
        $rating = $request->input('rating');

        $existingGrade = Grade::where('company_id', $companyId)
                              ->where('user_id', $userId)
                              ->first();

        if ($existingGrade) {
            $existingGrade->where('company_id', $companyId)->where('user_id', $userId)->update(['value' => $rating]);
            return redirect()->route('companies.index')->with('success', 'Note modifiée avec succès.');
        }

        $grade = new Grade();
        $grade->value = $rating;
        $grade->company_id = $companyId;
        $grade->user_id = $userId;
        $grade->save();

        return redirect()->route('companies.index')->with('success', 'Note enregistrée avec succès.');
    }

    public function stats()
    {
        $averageGrade = Company::with('grades')->get()->map(function ($company) {
            return $company->grades->avg('value');
        })->avg();

        $averageGrade = round($averageGrade, 2);

        $companiesWithMostOffers = Company::withCount('offers')->orderByDesc('offers_count')->limit(3)->get();

        $companiesWithMostApplications = Company::withCount('offers')
        ->withSum('offers', 'applies_count')
        ->orderByDesc('offers_sum_applies_count')
        ->limit(3)
        ->get();

        $sectorsWithMostCompanies = Company::select('sector', DB::raw('COUNT(*) AS sector_count'))
        ->groupBy('sector')
        ->orderByRaw('sector_count DESC')
        ->limit(3)
        ->get();

        $departmentsWithMostCompanies = Company::select(DB::raw('REPLACE(JSON_UNQUOTE(JSON_EXTRACT(localization, CONCAT(\'$[\', numbers.n, \'].dep\'))), \'"\', \'\') AS dep'))
        ->selectRaw('COUNT(*) AS companies_count')
        ->crossJoin(DB::raw('(SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) AS numbers'))
        ->whereNotNull(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(localization, CONCAT(\'$[\', numbers.n, \'].dep\')))'))
        ->groupBy('dep')
        ->orderByDesc('companies_count')
        ->limit(3)
        ->get();

        return view('companies.stats', compact('averageGrade', 'companiesWithMostOffers', 'companiesWithMostApplications', 'sectorsWithMostCompanies', 'departmentsWithMostCompanies'));
    }

    public function hide($id)
    {
        $companies = Company::findOrFail($id);
        $companies->status = 'hidden';
        $companies->save();

        //Quand on cache une entreprise, on cache aussi toutes ses offres
        Offer::where('company_id', $id)->update(['status' => 'hidden']);


        return redirect()->route('companies.index');
    }

    public function hidden()
    {
        $user = auth()->user();
        if($user->role === 'user'){
            return redirect()->route('companies.index');
        }

        $hiddenCompanies = Company::where('status', 'hidden')->get();
        foreach ($hiddenCompanies as $company) {
            $company->localizations = json_decode($company->localization);
        }

        return view('companies.hidden', compact('hiddenCompanies'));
    }


    public function active($id)
    {
        $company = Company::findOrFail($id);
        $company->status = 'active';
        $company->save();

        return redirect()->route('companies.hidden');
    }

    public function localizations($id){
        $company = Company::findOrFail($id);
        $localizations = json_decode($company->localization);
        return new JsonResponse($localizations);
    }


}
