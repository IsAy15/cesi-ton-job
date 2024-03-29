<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Level;
use App\Models\UserLevel;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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

    $user->save();

    if ($user) {
        $userId = $user->id;

        $levelTitle = $request->input('level');

        $level = UserLevel::whereHas('level', function ($query) use ($levelTitle) {
            $query->where('title', $levelTitle);
        })->first();

        if ($level) {
            $user->userLevels()->save($level);
        }

        $user->promotions()->attach($request->promotion, ['user_id' => $userId]);

        return redirect()->route('auth.confirmation');
    }
}




    public function confirmation()
    {
        return view('auth.confirmation');
    }

    
}
