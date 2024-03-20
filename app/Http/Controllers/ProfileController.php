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

    public function wishlist()
    {
        $user = auth()->user();
        $wishlist = $user->wishlist;
        return view('profile.wishlist', compact('wishlist'));
    }

    public function offers()
    {
        $user = auth()->user();
        $appliedOffers = $user->offers()->get(); // Utilisez get() pour récupérer les offres
        return view('profile.offers', compact('appliedOffers'));
    }


}

