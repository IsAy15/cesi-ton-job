<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion; 
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;
use App\Models\UserLevel;
use App\Models\Level;

class UserController extends Controller

{
    public function index()
{
    $user = auth()->user();

    if ($user->role === 'user') {
        return redirect()->route('profile.index');
    }

    if ($user->role === 'pilote') {
        $pilotePromotionIds = $user->promotions->pluck('id')->toArray();
        $userLevelIds = $user->userLevels->pluck('level_id')->toArray();

        $usersWithPromotions = User::with(['promotions', 'userLevels.level'])
            ->where('id', '!=', $user->id)
            ->whereHas('promotions', function ($query) use ($pilotePromotionIds) {
                $query->whereIn('id', $pilotePromotionIds);
            })
            ->where('status', 'approved')
            ->where('role', 'user')
            ->whereHas('userLevels', function ($query) use ($userLevelIds) {
                $query->whereIn('level_id', $userLevelIds);
            })
            ->get();
    } else {
        $usersWithPromotions = User::with(['promotions', 'userLevels.level'])
            ->where('status', 'approved')
            ->get();
    }

    return view('users.index', compact('usersWithPromotions'));
}



    public function show($id)
    {
        $user = User::with('userLevels.level')->find($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        $promotions = Promotion::all();
        $levels = Level::all();
        $userLevels = UserLevel::all();
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
        
        return view('users.create', compact('roles', 'promotions', 'userLevels', 'levels'));
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

    if ($user->role !== 'admin' && $request->has('promotion')) {
        $user->promotions()->sync([$request->promotion]);
    }

    $level = Level::where('title', $request->level)->first();

    if ($level) {
        $userLevel = new UserLevel();
        $userLevel->user_id = $user->id; 
        $userLevel->level_id = $level->id; 
        $userLevel->save();
    } 

    return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
}


    public function edit($id)
    {
        $user = User::find($id);
        $levels = Level::all();
        $Currentuser = auth()->user();

        if ($Currentuser->role === 'user') {
            return redirect()->route('profile.index');
        }

        $promotions = Promotion::all();
        return view('users.edit', compact('user', 'promotions', 'levels'));
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

    $levelTitle = $request->input('level');
    $level = Level::where('title', $levelTitle)->first();

    $user->userLevels()->delete();

    $userLevel = new UserLevel();
    $userLevel->user_id = $user->id;
    $userLevel->level_id = $level->id;
    $userLevel->save();

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
        DB::table('user_levels')->where('user_id', $id)->delete();

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
