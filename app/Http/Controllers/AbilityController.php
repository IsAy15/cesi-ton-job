<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ability;

class AbilityController extends Controller
{
    public function index(){
        $user = auth()->user();
        if($user->role === 'user'){
            return redirect()->route('profile.index');
        }
        $abilities = Ability::all();
        return view("abilities.index",compact("abilities"));
    }

    public function create(){
        return view("abilities.create");
    }

    public function store(Request $request){
        $user = auth()->user();
        if($user->role === 'user'){
            return redirect()->route('profile.index');
        }
        $ability = new Ability();
        $ability->title = $request->input('ab_title');
        $ability->description = $request->input('ab_description');
        $ability->save();
        return redirect()->route('abilities.index');
    }

    public function edit($id){
        $ability = Ability::where('id', $id)->first();
        return view('abilities.edit', compact('ability'));
    }

    public function update(Request $request, $id){
        $user = auth()->user();
        if($user->role === 'user'){
            return redirect()->route('profile.index');
        }
        $ability = Ability::findOrFail($id);
        $ability->title = $request->input('ab_title');
        $ability->description = $request->input('ab_description');
        $ability->save();
        return redirect()->route('abilities.index');
    }

    public function destroy($id){
        $user = auth()->user();
        if($user->role === 'user'){
            return redirect()->route('profile.index');
        }
        $ability = Ability::findOrFail($id);
        $ability->delete();
        return redirect()->route('abilities.index');
    }
}
