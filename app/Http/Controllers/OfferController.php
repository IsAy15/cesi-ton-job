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
    Offer::where('starting_date', '<', now())->update(['status' => 'hidden']);
    $promotions = Promotion::all();
    $companies = Company::all();
    $contractTypes = Offer::distinct()->pluck('type');

    $offersQuery = Offer::where('status', '!=', 'hidden');

    if (auth()->check() && auth()->user()->role === 'user'){
        $offersQuery->whereNotIn('id', auth()->user()->offers->pluck('id'));
    }

    $offers = $offersQuery->paginate(10);

    return view("offers.index", compact("offers", "promotions", "companies", "contractTypes"));
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

      $application = Application::where('user_id', auth()->id())->where('offer_id', $offer->id)->first();


      return view('offers.show', compact('offer', 'isInWishlist', 'isApplied', 'user', 'application'));
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

      $offer->save();

      if($offer -> starting_date < now()){
        return redirect()->route('offers.create')->with('error', 'La date de début doit être supérieure à la date actuelle.');
      }

      if($offer -> starting_date > $offer -> ending_date){
        return redirect()->route('offers.create')->with('error', 'La date de fin doit être supérieure à la date de début.');
      }


      $offer->levels()->attach($request->input('of_level_id'));
      $abilitiesArray = json_decode($request->input('of_abilities'), true);
      $abilities = array_column($abilitiesArray, 'id');
      $offer->abilities()->attach($abilities);

      return redirect()->route('offers.index');
  }




  public function edit($id)
    {
      $promotions = Promotion::all();
      $offer = Offer::findOrFail($id);
      $companies = Company::all();
      $user = auth()->user();
      $offerabilities = $offer->abilities->pluck('id')->toArray();
      $allabilities = Ability::wherenotin('id', $offerabilities)->get();

      if ($user->role === 'user') {
      return redirect()->route('offers.index');
    }
      return view('offers.edit', compact('offer', 'companies','promotions', 'allabilities'));
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
        $abilitiesArray = json_decode($request->input('of_abilities'), true);
        $abilities = array_column($abilitiesArray, 'id');
        $offer->abilities()->sync($abilities);

        if($offer -> starting_date < now()){
          return redirect()->route('offers.edit')->with('error', 'La date de début doit être supérieure à la date actuelle.');
        }

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

    DB::table('offer_levels')->where('offer_id', $id)->delete();

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

      $cvPath = $request->file('cv')->store('public/cv');
      $letterPath = $request->file('letter')->store('public/lettre_motivation');


      $application = new Application();
      $application->cv = $cvPath;
      $application->letter = $letterPath;
      $application->offer_id = $id;
      $application->user_id = auth()->id();
      $application->save();

      $offer = Offer::findOrFail($id);
      $offer->increment('applies_count');

      return redirect()->route('offers.index', $id)->with('success', 'Votre candidature a été soumise avec succès.');
  }

  public function stats()
  {
      $offersWithMostApplications = Offer::withCount('applications')->orderByDesc('applies_count')->take(3)->get();

      $offersInWishlist = Offer::withCount('wishlist')->orderByDesc('wishlist_count')->take(3)->get();

      $topAbilities = Ability::withCount('offers')->orderByDesc('offers_count')->limit(3)->get();

      $longestInternshipOffer = Offer::where('type', 'stage')
      ->orderByRaw('DATEDIFF(ending_date, starting_date) DESC')
      ->first();

      $departmentsWithMostOffers = Offer::select(DB::raw('REPLACE(JSON_EXTRACT(localization, "$.dep"), "\"", "") AS dep'), DB::raw('COUNT(*) AS offers_count'))
            ->groupBy('dep')
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

  public function active($id)
  {
      $offer = Offer::findOrFail($id);
      $offer->status = 'active';
      $offer->save();

      return redirect()->route('offers.hidden');
  }

  public function hidden()
  {
    $user=auth()->user();
    if($user->role === 'user'){
        return redirect()->route('offers.index');
    }
    $hiddenOffers = Offer::where('status', 'hidden')
    ->where('starting_date', '>', now())
    ->get();
    return view('offers.hidden', compact('hiddenOffers'));
  }

  public function outdated()
  {
    $user=auth()->user();
    if($user->role === 'user'){
        return redirect()->route('offers.index');
    }

    $offers = Offer::where(function ($query) {
        $query->where('starting_date', '<', now())
              ->where('status', 'hidden');
      })->get();

      return view("offers.outdated", compact("offers"));
  }


}
