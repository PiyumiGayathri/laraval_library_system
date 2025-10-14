<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nic' => 'required|string|unique:users,nic',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile' => 'required|string|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
        ]);

        Users::create([
            'nic' => $request->nic,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'registered_at' => now(),
        ]);

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }
}
