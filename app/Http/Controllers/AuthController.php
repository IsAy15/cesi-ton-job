<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

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