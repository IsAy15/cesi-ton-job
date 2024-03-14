<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }
    

    public function store(Request $request)
{
    $company = new Company();
    $company->name = $request->input('cp_name');
    $company->sector = $request->input('cp_sector');
    $company->localization = $request->input('cp_localization');
    $company->save();
    return redirect()->route('companies.index');
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
    $company = Company::find($id);
    $company->delete();
    return redirect()->route('companies.index');
}


}
