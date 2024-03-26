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
            
            $company->average_grade = $averageGrade;
        }

        return view('companies.index', compact('companies'));
    }


    public function create()
    {
        return view('companies.create');
    }
    

    public function store(Request $request)
    {
        $company = new Company();
        $company->name = $request->input('cp_name');
        $company->sector = $request->input('cp_sector');
        $company->localization = $request->input('cp_localization');
        $company->save();
        
        // Vérifie si l'utilisateur souhaite créer une offre pour cette entreprise
        if ($request->has('create_offer')) {
            return redirect()->route('offers.create')->with('company_id', $company->id);
        } else {
            return redirect()->route('companies.index');
        }
    }


    public function edit($id)
    {
        $company = Company::find($id);
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

    public function saveRating(Request $request)
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

}
