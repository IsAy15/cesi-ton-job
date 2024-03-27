<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion; 
use App\Models\Offer;
use App\Models\Auth;
use App\Models\Wishlist;



class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); 
        return view('profile.index', compact('user'));
    }

    public function pending()
    {
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

    public function wishlist()
    {
        $user = auth()->user();
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

