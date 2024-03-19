<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion; 
use App\Models\Offer;
use App\Models\Auth;



class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Ou récupérez l'utilisateur d'une autre manière
        return view('profile.index', compact('user'));
    }

    public function offers()
    {
        $user = auth()->user();
        $appliedOffers = $user->appliedOffers;
        return view('profile.offers', compact('appliedOffers'));
    }


}
