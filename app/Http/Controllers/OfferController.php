<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Company;
use App\Http\CompanyControllers;


class OfferController extends Controller
{
  public function index(){
    $offers = Offer::all();
    return view("offers.index",compact("offers"));
  }

  public function company()
  {
      return $this->belongsTo(Company::class);
  }

  public function show($id)
  {
      $offer = Offer::findOrFail($id);
      return view('offers.show', compact('offer'));
  }



  public function create()
  {
      $companies = Company::all();
      return view("offers.create", compact("companies"));
  }

  public function store(Request $request){
    $offer = new Offer();
    $offer->title = $request->input('of_title');
    $offer->description = $request->input('of_description');
    $offer->localization = $request->input('of_localization');
    $offer->starting_date = $request->input('of_starting_date');
    $offer->ending_date = $request->input('of_ending_date');
    $offer->places = $request->input('of_places');
    $offer->salary = $request->input('of_salary');
    $offer->applies_count = $request->input('of_applies_count');
    $offer->type = $request->input('of_type');
    $offer->company_id = $request->input('of_company_id'); // Assurez-vous de récupérer la valeur de company_id depuis le formulaire
    $offer->save();
    return redirect()->route('offers.index');
}


  public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $companies = Company::all(); // Récupère toutes les entreprises
        return view('offers.edit', compact('offer', 'companies'));
    }


  public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->title = $request->input('of_title');
        $offer->description = $request->input('of_description');
        $offer->localization = $request->input('of_localization');
        $offer->starting_date = $request->input('of_starting_date');
        $offer->ending_date = $request->input('of_ending_date');
        $offer->places = $request->input('of_places');
        $offer->salary = $request->input('of_salary');
        $offer->applies_count = $request->input('of_applies_count');
        $offer->type = $request->input('of_type');
        
        // Récupérer la nouvelle valeur de company_id depuis le formulaire
        $company_id = $request->input('of_company_id');
        $offer->company_id = $company_id;
        
        $offer->save();
        return redirect()->route('offers.index');
    }


  public function destroy($id){
    $offer = Offer::where('id', $id)->delete();
    return redirect()->route('offers.index');
  }


  public function apply($id)
  {
      $offer = Offer::findOrFail($id);
      return view('offers.apply', compact('offer'));
  }

}
