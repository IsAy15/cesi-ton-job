<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion; 
use App\Models\Offer;
use App\Models\Auth;
use App\Models\Wishlist;
use App\Models\Ability;
use Illuminate\Support\Facades\DB;



class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); 
        $userabilities = $user->abilities->pluck('id')->toArray();
        $allabilities = Ability::wherenotin('id', $userabilities)->get();
        return view('profile.index', compact('user','userabilities' ,'allabilities'));
    }

    public function add()
    {
        $user=auth()->user();
        $userabilities = $user->abilities->pluck('id')->toArray();
        $allabilities = Ability::wherenotin('id', $userabilities)->get();
        return view('profile.add', compact('allabilities', 'userabilities'));
    }

    public function store(Request $request)
{
    $user = auth()->user();

    $abilitiesIds = $request->abilities;
        
    $user->abilities()->attach($abilitiesIds);

    // return redirect()->route('profile.index')->with('success', 'Compétences ajoutées avec succès.');  
}


    public function pending()
    {
        $user = auth()->user();

        if ($user->role === 'pilote') {
            $pilotepromotion = $user->promotions->pluck('id')->toArray();

            $pendingUsers = User::where('role', 'user')
                                ->whereHas('promotions', function($query) use ($pilotepromotion) {
                                    $query->whereIn('id', $pilotepromotion);
                                })
                                ->where('status', 'pending')
                                ->get();

            return view('profile.pending', compact('pendingUsers'));
        }

        $pendingUsers = User::where('status', 'pending')->get();
        return view('profile.pending', compact('pendingUsers'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        // return redirect()->route('profile.pending')->with('success', 'Le statut de l\'utilisateur a été changé avec succès.');
    }

    public function destroy(Request $request)
    {
        $id = $request->ability;
        DB::table('student_abilities')->where('ability_id', $id)->delete();

        // return redirect()->route('profile.index')->with('success', 'La compétence a été supprimée avec succès.');
    }


    public function wishlist()
    {
        $user = auth()->user();

        if ($user->role === 'pilote') {
            return redirect()->route('profile.index');
        }
        $wishlist = $user->wishlist;
        return view('profile.wishlist', compact('wishlist'));
    }

    public function offers()
    {
        $user = auth()->user();
        $appliedOffers = $user->offers;
        return view('profile.offers', compact('appliedOffers'));
    }
}

