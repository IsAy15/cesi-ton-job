<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion; 

class UserController extends Controller
{
    public function index()
    {
        // Récupérer tous les utilisateurs avec leurs promotions associées
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

        // Création d'un nouvel utilisateur
        $user = new User();
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password; // Assurez-vous de hasher le mot de passe
        $user->save();

        // Attachement de l'utilisateur à la promotion sélectionnée
        $user->promotions()->attach($request->promotion);

        // Redirection avec un message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

}
