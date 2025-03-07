<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;


class WishlistController extends Controller
{
 
    public function removeFromWishlist(Request $request, $offerId)
    {
        $user = auth()->user();
        $user->wishlist()->detach($offerId);

        return redirect()->back()->with('success', 'L\'offre a été supprimée de votre wishlist avec succès.');
    }

    public function addToWishlist(Request $request, $offerId)
    {
        if (auth()->check()) {
            $offer = Offer::find($offerId);

            if ($offer) {
                if (!auth()->user()->wishlist()->where('offer_id', $offerId)->exists()) {
                    auth()->user()->wishlist()->attach($offerId);

                    return redirect()->back()->with('success', 'L\'offre a été ajoutée à votre wishlist.');
                } else {
                    return redirect()->back()->with('error', 'L\'offre est déjà dans votre wishlist.');
                }
            } else {
                return redirect()->back()->with('error', 'L\'offre sélectionnée n\'existe pas.');
            }
        } else {
            return redirect()->route('auth.login')->with('error', 'Veuillez vous connecter pour ajouter des offres à votre wishlist.');
        }
    }

}
