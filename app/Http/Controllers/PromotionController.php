<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;


class PromotionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if($user->role !== 'admin'){
            return redirect()->route('profile.index');
        }
        $promotions = Promotion::all();
        return view('promotions.index', compact('promotions'));
    }

    public function create()
    {
        $user = auth()->user();
        if($user->role !== 'admin'){
            return redirect()->route('profile.index');
        }
        return view('promotions.create');
    }

    public function store(Request $request)
    {
        // Store
        $promotion = new Promotion();
        $promotion->name = $request->name;
        $promotion->save();

        return redirect()->route('promotions.index');
    }

    public function edit($id)
    {
        $user = auth()->user();
        if($user->role !== 'admin'){
            return redirect()->route('profile.index');
        }
        $promotion = Promotion::find($id);
        return view('promotions.edit', compact('promotion'));
    }

    public function update(Request $request, $id)
    {
        // Update
        $promotion = Promotion::find($id);
        $promotion->name = $request->name;
        $promotion->save();

        return redirect()->route('promotions.index');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        if($user->role !== 'admin'){
            return redirect()->route('profile.index');
        }
    
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    
        Offer::where('promotion_id', $id)->delete();
        
        Promotion::destroy($id);
    
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    
        return redirect()->route('promotions.index')->with('success', 'Promotion supprimée avec succès');
    }
    


    public function showUsers($id)
    {
        $promotion = Promotion::findOrFail($id);
        $users = $promotion->users;

        return view('promotions.users', compact('promotion', 'users'));
    }

    public function addUser($id)
    {
        $promotion = Promotion::findOrFail($id);
        $users = User::whereNotIn('id', function($query) {
        $query->select('user_id')
              ->from('user_promotions');
            })->get();
            return view('promotions.addUser', compact('promotion', 'users'));
        }

    public function storeUser(Request $request, $id)
    {
    
        $promotion = Promotion::findOrFail($id);
        $user = User::findOrFail($request->user);
    
        $promotion->users()->attach($user);
    
        return redirect()->route('promotions.users', $promotion->id);
    }

    public function removeUser($userId, $promotionId)
    {
        $promotion = Promotion::findOrFail($promotionId);
    
        $promotion->users()->detach($userId);
        
        return redirect()->route('promotions.users', $promotion->id)->with('success', 'Utilisateur supprimé de la promotion avec succès');

    }

   
}
