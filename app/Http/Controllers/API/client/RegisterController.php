<?php

namespace App\Http\Controllers\API\client;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'full_name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'account_status' => 'active',
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Đăng ký thành công!',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
