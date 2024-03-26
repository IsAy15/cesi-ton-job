<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion; 
use App\Models\Wishlist;

class UserController extends Controller
{
    public function index()
    {
        $usersWithPromotions = User::with('promotions')->get();

        return view('users.index', compact('usersWithPromotions'));
    }

    public function create()
    {
        $promotions = Promotion::all();
        return view('users.create', compact('promotions'));
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
            'promotion' => 'required|exists:promotions,id',
        ]);

        $user = new User();
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password; 
        $user->status = 'approved';
        $user->save();

        $user->promotions()->attach($request->promotion);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $promotions = Promotion::all();
        return view('users.edit', compact('user', 'promotions'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'required|min:6',
            'promotion' => 'required|exists:promotions,id',
        ]);

        $user = User::find($id);
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password;
        $user->promotions()->sync($request->input('promotion'));
        $user->save();

        $user->promotions()->sync($request->promotion);

        return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès.');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }


}
