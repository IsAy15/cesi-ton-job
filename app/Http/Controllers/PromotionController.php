<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\User;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('promotions.create');
    }

    public function store(Request $request)
    {
        // Store
        $promotion = new Promotion();
        $promotion->name = $request->name;
        $promotion->save();

        return redirect()->route('promotions.index');
    }

    public function edit($id)
    {
        $promotion = Promotion::find($id);
        return view('promotions.edit', compact('promotion'));
    }

    public function update(Request $request, $id)
    {
        // Update
        $promotion = Promotion::find($id);
        $promotion->name = $request->name;
        $promotion->save();

        return redirect()->route('promotions.index');
    }

    public function destroy($id)
    {
        // Delete
        $promotion = Promotion::find($id);
        $promotion->delete();

        return redirect()->route('promotions.index');
    }

    public function showUsers($id)
    {
        $promotion = Promotion::findOrFail($id);
        $users = $promotion->users;

        return view('promotions.users', compact('promotion', 'users'));
    }


}
