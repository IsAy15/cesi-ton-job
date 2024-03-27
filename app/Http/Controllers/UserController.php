<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion; 
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;

class UserController extends Controller

{
    public function index()
    {
        $currentUser = auth()->user();

        if ($currentUser->role === 'user') {
            return redirect()->route('profile.index');
        }

        if ($currentUser->role === 'pilote'){
            $pilotePromotionId = $currentUser->promotions->pluck('id')->toArray();
            $usersWithPromotions = User::with('promotions')
                ->where('id', '!=', $currentUser->id)
                ->whereHas('promotions', function ($query) use ($pilotePromotionId) {
                    $query->whereIn('id', $pilotePromotionId);
                })
                ->where('status', 'approved')
                ->get();
        } else {
            $usersWithPromotions = User::with('promotions')
                ->where('status', 'approved')
                ->get();
        }

        return view('users.index', compact('usersWithPromotions'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        $promotions = Promotion::all();
        $user = auth()->user();


        if ($user->role === 'user') {
            return redirect()->route('profile.index');
        }
        
        $roles = [
            'user' => 'Utilisateur',
            'admin' => 'Administrateur',
            'pilote' => 'Pilote',
        ];

        if ($user->role == 'pilote') {
            $roles = ['user' => 'Utilisateur'];
        }
        
        return view('users.create', compact('roles', 'promotions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = md5($request->password); 
        $user->status = 'approved';
        $user->save();

        $user->promotions()->attach($request->promotion);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $Currentuser = auth()->user();

        if ($Currentuser->role === 'user') {
            return redirect()->route('profile.index');
        }

        $promotions = Promotion::all();
        return view('users.edit', compact('user', 'promotions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->role === 'admin' && $request->has('role')) {
            $request->merge(['role' => 'admin']);
        }

        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        if ($user->role !== 'admin' && $request->has('promotion')) {
            $user->promotions()->sync([$request->promotion]);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès.');
    }

    public function destroy($id)
    {
        DB::table('grades')->where('user_id', $id)->delete();
        DB::table('user_promotions')->where('user_id', $id)->delete();
        DB::table('student_abilities')->where('user_id', $id)->delete();
        DB::table('applications')->where('user_id', $id)->delete();
        DB::table('user_offer')->where('user_id', $id)->delete();
        DB::table('user_wishlist')->where('user_id', $id)->delete();

        $user = User::findOrFail($id);
        $Currentuser = auth()->user();

        if ($Currentuser->role === 'user') {
            return redirect()->route('profile.index');
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
