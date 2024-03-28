<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Grade;
use App\Models\Offer;
use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $grades = Grade::where('company_id', $company->id)->pluck('value');
            
            $averageGrade = $grades->avg();
            
            $company->average_grade = round($averageGrade,1);
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
        $company->localization = $request->input('cp_localization');
        $company->save();
        
        if ($request->has('create_offer')) {
            // Redirige vers la création d'une offre en passant l'id de l'entreprise dans l'url
            return redirect()->route('offers.create')->with('company', $company->id);
        } else {
            return redirect()->route('companies.index');
        }
    }


    public function edit($id)
    {
        $company = Company::find($id);

        $user = auth()->user();
      
      if ($user->role === 'user') {
        return redirect()->route('companies.index');
    }

        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->name = $request->input('cp_name');
        $company->sector = $request->input('cp_sector');
        $company->localization = $request->input('cp_localization');
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


        public function stats($id)
    {
        $company = Company::findOrFail($id);
        $totalApplications = $company->offers()->sum('applies_count');
        $offers = $company->offers()->get();

        return view('companies.stats', compact('company', 'totalApplications', 'offers'));
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

    public function data()
    {
        $averageGrade = Company::with('grades')->get()->map(function ($company) {
            return $company->grades->avg('value');
        })->avg();

        $averageGrade = round($averageGrade, 2);


        $companyWithMostOffers = Company::withCount('offers')->orderByDesc('offers_count')->first();

        $companyWithMostApplications = Company::withCount('offers')
        ->withSum('offers', 'applies_count') 
        ->orderByDesc('offers_sum_applies_count')
        ->first();

        $sectorWithMostCompanies = Company::select('sector')
        ->groupBy('sector')
        ->orderByRaw('COUNT(*) DESC')
        ->first();

        $departmentWithMostCompanies = Company::select(DB::raw('LEFT(localization, 2) AS code'), DB::raw('COUNT(*) AS companies_count'))
        ->groupBy('code')
        ->orderByDesc('companies_count')
        ->first();
    
        return view('companies.data', compact('averageGrade', 'companyWithMostOffers', 'companyWithMostApplications', 'sectorWithMostCompanies', 'departmentWithMostCompanies'));
    }
}
