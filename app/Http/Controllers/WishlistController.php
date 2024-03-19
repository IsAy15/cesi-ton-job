<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;


class WishlistController extends Controller
{
 
    public function removeFromWishlist(Request $request, $offerId)
    {
        if (!auth()->check()) {
            return redirect()->route('auth.login')->with('error', 'Veuillez vous connecter pour gérer votre wishlist.');
        }

        $user = auth()->user();

        $wishlistItem = $user->wishlist()->where('offer_id', $offerId)->first();

        if (!$wishlistItem) {
            return redirect()->back()->with('error', 'Cette offre n\'est pas dans votre wishlist.');
        }

        $wishlistItem->delete();

        return redirect()->back()->with('success', 'L\'offre a été supprimée de votre wishlist avec succès.');
    }

    public function addToWishlist(Request $request, $offerId)
    {
        if (auth()->check()) {
            $offer = Offer::find($offerId);

            if ($offer) {
                // Vérifie si l'offre n'est pas déjà dans la wishlist de l'utilisateur
                if (!auth()->user()->wishlist()->where('offer_id', $offerId)->exists()) {
                    // Attache l'offre à la wishlist de l'utilisateur
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


    public function deleteOffer($offerId)
{
    // Supprimer les enregistrements dans la table 'applications' qui référencent l'offre à supprimer
    DB::table('applications')->where('offer_id', $offerId)->delete();

    // Supprimer l'offre de la table 'offers'
    $offer = Offer::findOrFail($offerId);
    $offer->delete();

    return redirect()->route('offers.index')->with('success', 'Offre supprimée avec succès');
}

}
