<?php

namespace App\Http\Controllers\API\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController 
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

    /**
     * Xử lý API login
     */
   public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'success'=> false,
                'message'=> 'Validation error',
                'data'=> $validator->errors(),
            ], 422);
        }

        // Xử lý đăng nhập

        $user = User::Where('email', $data['email'])->first();
        if (!$user || !password_verify($data['password'], $user->password)) {
            return response()->json([
                'success'=> false,
                'message'=> 'Invalid credentials',
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'success'=> true,
            'message'=> 'Login successfully',
            'data'=> [
                'user' => $user,
                'token' => $token,
            ],
        ], 200);
        

    }
}
