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

    public function pilotes($role)
    {
        $users = User::where('user_role', 'pilote')->get();
        return view('admin.pilotes.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->user_lastname = $request->input('user_lastname');
        $user->user_firstname = $request->input('user_firstname');
        $user->user_email = $request->input('user_email');
        $user->user_role = $request->input('user_role');
        $user->save();
        return redirect()->route('admin.pilotes.index');
    }

    public function edit($id)
    {
        $user = User::where('user_id', $id)->first();
        return view('admin.pilotes.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('user_id', $id)->first();
        $user->user_lastname = $request->input('user_lastname');
        $user->user_firstname = $request->input('user_firstname');
        $user->user_email = $request->input('user_email');
        $user->user_password = $request->input('user_password');
        $user->user_role = $request->input('user_role');
        $user->save();
        return redirect()->route('admin.pilotes.index');
    }

    public function destroy($id)
    {
        $user = User::where('user_id', $id)->delete();
        return redirect()->route('admin.pilotes.index');
    }
}
