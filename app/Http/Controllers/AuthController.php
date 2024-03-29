<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Level;
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

        if ($user) {
            if ($user->status === 'approved' && md5($credentials['password']) === $user->password) {
                Auth::login($user);

                if ($user->role === 'admin' || $user->role === 'pilote') {
                    return redirect()->intended(route('users.index'));
                } else {
                    return redirect()->intended(route('profile.index'));
                }
            } else {
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'Votre compte est en attente de validation.',
                ]);
            }
        }

        return redirect()->back()->withInput()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }

    public function register()
    {
        $promotions = Promotion::all();
        $levels = Level::all();
        return view('auth.register', compact('promotions', 'levels'));
    }

    public function doregister(Request $request)
{
    $existingUser = User::where('email', $request->email)->first();

    if ($existingUser) {
        return redirect()->back()->withInput()->withErrors(['email' => 'Cette adresse e-mail est déjà utilisée. Veuillez en choisir une autre.']);
    }

    $user = new User();
    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;
    $user->email = $request->email;
    $user->password = md5($request->password);
    $user->role = $request->role;

    // Récupérer le niveau de l'utilisateur à partir de la requête
    $levelTitle = $request->input('level');
    // Trouver le niveau correspondant dans la base de données
    $level = Level::where('title', $levelTitle)->first();
    // Associer le niveau à l'utilisateur
    $user->level()->associate($level);

    $user->save();

    if ($user) {
        $userId = $user->id;

        $user->promotions()->attach($request->promotion, ['user_id' => $userId]);

        return redirect()->route('auth.confirmation');
    }


}



    public function confirmation()
    {
        return view('auth.confirmation');
    }

    
}
