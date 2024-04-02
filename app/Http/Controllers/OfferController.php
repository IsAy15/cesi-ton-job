<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Offer;
use App\Models\Company;
use App\Models\Ability;
use App\Models\Application;
use App\Models\Promotion;
use App\Models\Level;



class OfferController extends Controller
{
  public function index(){
    $offers = Offer::where('status', '!=', 'hidden')->get();
    $promotions = Promotion::all();
    $companies = Company::all();
    $contractTypes = Offer::distinct()->pluck('type');

    if (auth()->check() && auth()->user()->role === 'user'){
      $offers = $offers->diff(auth()->user()->offers);
    }
    
    return view("offers.index",compact("offers","promotions","companies", "contractTypes"));
  }

  public function company()
  {
      return $this->belongsTo(Company::class);
  }

  

  public function show($id)
  {
    $user = auth()->user(); 
      $offer = Offer::findOrFail($id);
      $isInWishlist = auth()->check() ? auth()->user()->wishlist->contains($offer) : false;
      $isApplied = auth()->check() ? auth()->user()->offers->contains($offer) : false;

      return view('offers.show', compact('offer', 'isInWishlist', 'isApplied', 'user'));
  }
  
  public function create(Request $request)
  {
      $selected_company = session('company');

      $companies = Company::all();

      $user = auth()->user();
      $promotions = Promotion::all();
      $levels = Level::all();
      $abilities = Ability::all();
      
      if ($user->role === 'user') {
        return redirect()->route('offers.index');
    }

      return view("offers.create", compact("companies", "selected_company","promotions","levels","abilities"));
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
      $offer->applies_count = 0;
      $offer->promotion_id = $request->input('of_promotion_id');

      $offer->levels()->attach($request->input('level_id'));
      $offer->abilities()->attach($request->input('abilities'));



      $offer->save();
      return redirect()->route('offers.index');
  }




  public function edit($id)
    {
      $promotions = Promotion::all(); 
      $offer = Offer::findOrFail($id);
      $companies = Company::all();
      $user = auth()->user();
        
      if ($user->role === 'user') {
      return redirect()->route('offers.index');
    }
      return view('offers.edit', compact('offer', 'companies','promotions'));
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
        
        $company_id = $request->input('of_company_id');
        $offer->promotion_id = $request->input('of_promotion_id');
        $offer->company_id = $company_id;
        
        $offer->save();
        return redirect()->route('offers.index');
    }


    public function destroy($id)
{
    $user = auth()->user();
      
      if ($user->role === 'user') {
        return redirect()->route('offers.index');
    }
    
    DB::table('offer_requirements')->where('of_id', $id)->delete();

    DB::table('user_offer')->where('offer_id', $id)->delete();

    DB::table('applications')->where('offer_id', $id)->delete();

    DB::table('user_wishlist')->where('offer_id', $id)->delete();
    
    $offer = Offer::findOrFail($id);
    $offer->delete();

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

  public function stats()
  {
      $offersWithMostApplications = Offer::withCount('applications')->orderByDesc('applications_count')->take(5)->get();
      
      $offersInWishlist = Offer::withCount('wishlist')->orderByDesc('wishlist_count')->take(5)->get();
      
      $topAbilities = Ability::withCount('offers')->orderByDesc('offers_count')->take(3)->get();
      
      $longestInternshipOffer = Offer::where('type', 'stage')
      ->orderByRaw('DATEDIFF(ending_date, starting_date) DESC')
      ->first();

      $departmentsWithMostOffers = Offer::select(DB::raw('LEFT(localization, 2) AS code'), DB::raw('COUNT(*) AS offers_count'))
      ->groupBy('code')
      ->orderByDesc('offers_count')
      ->limit(5)
      ->get();
      
      return view('offers.stats', compact('offersWithMostApplications', 'offersInWishlist', 'topAbilities', 'longestInternshipOffer', 'departmentsWithMostOffers'));
  }

  public function hide($id)
  {
      $offer = Offer::findOrFail($id);
      $offer->status = 'hidden';
      $offer->save();

      return redirect()->route('offers.index');
  }




}
