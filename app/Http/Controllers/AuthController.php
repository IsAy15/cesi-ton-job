<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    // Méthode pour afficher le formulaire de connexion
    public function login()
    {
        return view('auth.login');
    }

    // Méthode pour gérer la déconnexion de l'utilisateur
    public function logout()
    {
        Auth::logout(); // Déconnexion de l'utilisateur

        return redirect()->route('auth.login'); // Redirection vers la page de connexion
    }

    // Méthode pour traiter la soumission du formulaire de connexion
    public function dologin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->password == $credentials['password']) {
            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.pilotes.index'));
            } elseif ($user->role === 'pilote') {
                return redirect()->intended(route('companies.index'));
            } else {
                return redirect()->intended(route('promotions.index'));
            }
        }

        return redirect()->back()->withInput()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }
}
