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
            $campus = $user->campus;

            $usersCesi = User::with(['promotions', 'userLevels.level'])
                ->where('id', '!=', $user->id)
                ->where('status', 'approved')
                ->where('role', 'user')
                ->where('campus', $campus)
                ->whereHas('userLevels', function ($query) use ($userLevelIds) {
                    $query->whereIn('level_id', $userLevelIds);
                })
                ->whereHas('promotions', function ($query) use ($pilotePromotionIds) {
                    $query->whereIn('id', $pilotePromotionIds);
                })
                ->paginate(10);
        } else {
            $usersCesi = User::with(['promotions', 'userLevels.level'])
                ->where('status', 'approved')
                ->paginate(10);
        }

        return view('users.index', compact('usersCesi'));
    }



    public function show($id)
    {
        $user = User::with('userLevels.level')->find($id);
        if (auth()->user()->role === 'user' && auth()->id() != $id) {
            return redirect()->route('profile.index')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
        }
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
        $user->campus = $request->campus; 
        $user->status = 'approved';
    
        // Assigner l'avatar en fonction du rôle
        switch ($request->role) {
            case 'user':
                $user->avatar = 'user.jpg';
                break;
            case 'pilote':
                $user->avatar = 'pilote.jpg';
                break;
            case 'admin':
                $user->avatar = 'admin.jpg';
                break;
            default:
                $user->avatar = 'default.jpg'; 
                break;
        }
    
        $user->save();
    
        if ($user->role !== 'admin' && $request->has('promotion')) {
            $user->promotions()->sync([$request->promotion]);
        }
    
        $selectedLevels = $request->input('levels', []);
    
        foreach ($selectedLevels as $levelId) {
            $user->userLevels()->create(['level_id' => $levelId]);
        }
    
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }
    


    public function edit($id)
    {
        $CurrentUser = auth()->user();
        if ($CurrentUser->role === 'user') {
            return redirect()->route('profile.index');
        }

        $user = User::find($id);
        $levels = Level::all();
  

        $promotions = Promotion::all();
        return view('users.edit', compact('user', 'promotions', 'levels'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Utilisateur non trouvé.']);
        }

        $user->lastname = $request->input('lastname');
        $user->firstname = $request->input('firstname');
        $user->email = $request->input('email');

        // Vérifier si un nouveau mot de passe est fourni
        if ($request->filled('password')) {
            $user->password = md5($request->input('password'));
        }

        // Mettre à jour le rôle uniquement si l'utilisateur connecté est un admin
        if (auth()->user()->role === 'admin' && $request->filled('role')) {
            $user->role = $request->input('role');
        }

        $user->save();

        // Mettre à jour les niveaux sélectionnés
        $selectedLevels = $request->input('levels');
        $user->userLevels()->delete(); // Supprimer les anciens niveaux sélectionnés
        foreach ($selectedLevels as $levelId) {
            $user->userLevels()->create(['level_id' => $levelId]);
        }

        // Mettre à jour la promotion uniquement si l'utilisateur connecté est un admin
        if (auth()->user()->role === 'admin' && $request->filled('promotion')) {
            $user->promotions()->sync([$request->input('promotion')]);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès.');
    }



    public function destroy($id)
    {
        $CurrentUser = auth()->user();
        if ($CurrentUser->role === 'user') {
            return redirect()->route('profile.index');
        }

        DB::table('grades')->where('user_id', $id)->delete();
        DB::table('user_promotions')->where('user_id', $id)->delete();
        DB::table('student_abilities')->where('user_id', $id)->delete();
        DB::table('applications')->where('user_id', $id)->delete();
        DB::table('user_offer')->where('user_id', $id)->delete();
        DB::table('user_wishlist')->where('user_id', $id)->delete();
        DB::table('user_levels')->where('user_id', $id)->delete();

        $user = User::findOrFail($id); 
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
