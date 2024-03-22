<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Company;
use App\Http\CompanyControllers;
use App\Models\Application;



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
      $isInWishlist = auth()->check() ? auth()->user()->wishlist->contains($offer) : false;
      $isApplied = auth()->check() ? auth()->user()->offers->contains($offer) : false;
  
      $relatedOffers = Offer::where('company_id', $offer->company_id)
                          ->where('id', '!=', $offer->id) // Exclure l'offre actuelle
                          ->get();
      return view('offers.show', compact('offer', 'isInWishlist', 'isApplied', 'relatedOffers'));
  }
  




  public function create()
  {
      $companies = Company::all();
      return view("offers.create", compact("companies"));
  }

  public function store(Request $request)
{
    $offer = new Offer();
    $offer->title = $request->input('of_title');
    $offer->description = $request->input('of_description');
    $offer->localization = $request->input('of_localization');
    $offer->starting_date = $request->input('of_starting_date');
    $offer->ending_date = $request->input('of_ending_date');
    $offer->places = $request->input('of_places');
    $offer->salary = $request->input('of_salary');
    $offer->type = $request->input('of_type');
    $offer->company_id = $request->input('of_company_id');
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


  public function apply(Request $request, $id)
{
    $request->validate([
        'cv' => 'required|file|mimes:pdf|max:2048',
        'letter' => 'required|file|mimes:pdf|max:2048',
    ]);

    $cvPath = $request->file('cv')->store('cv');
    $letterPath = $request->file('letter')->store('letter');

    $application = new Application();
    $application->cv = $cvPath;
    $application->letter = $letterPath;
    $application->offer_id = $id;
    $application->user_id = auth()->id();
    $application->save();

    $offer = Offer::findOrFail($id);
    $offer->increment('applies_count');

    return redirect()->route('offers.show', $id)->with('success', 'Votre candidature a été soumise avec succès.');
} 

}
