<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
 

class AuthController extends Controller
{
    // Méthode pour afficher le formulaire de connexion
    public function login()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout(); 

        return redirect()->route('auth.login'); 
    }

    public function dologin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->password == $credentials['password']) {
            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->intended(route('users.index'));
            } elseif ($user->role === 'pilote') {
                return redirect()->intended(route('users.index'));
            } else {
                return redirect()->intended(route('profile.index'));
            }
        }

        return redirect()->back()->withInput()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }
}