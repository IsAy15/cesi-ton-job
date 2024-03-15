<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function pilotes()
    {
        $users = User::where('role', 'pilote')->get();
        return view('admin.pilotes.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pilotes.create');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->lastname = $request->input('user_lastname');
        $user->firstname = $request->input('user_firstname');
        $user->email = $request->input('user_email');
        $user->role = $request->input('user_role');
        $user->save();
        return redirect()->route('admin.pilotes.index');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.pilotes.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->lastname = $request->input('user_lastname');
        $user->firstname = $request->input('user_firstname');
        $user->email = $request->input('user_email');
        $user->role = $request->input('user_role');
        $user->save();
        return redirect()->route('admin.pilotes.index');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return redirect()->route('admin.pilotes.index');
    }
}
