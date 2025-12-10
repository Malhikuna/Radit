<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GET /users
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    /*
    |--------------------------------------------------------------------------
    | POST /users
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'nullable|in:admin,member',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? 'member',
        ]);

        return response()->json($user, 201);
    }

    /*
    |--------------------------------------------------------------------------
    | GET /users/{id}
    |--------------------------------------------------------------------------
    */
    public function show(User $user)
    {
        return $user;
    }

    /*
    |--------------------------------------------------------------------------
    | PUT /users/{id}
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'in:admin,member',
        ]);

        $user->update($data);

        return response()->json($user);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE /users/{id}
    |--------------------------------------------------------------------------
    */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}
