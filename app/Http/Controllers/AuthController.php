<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $validated = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = User::where('email', $validated['email'])->first();

            if (!$user) {
                return response()->json(['success' => false, 'err_msg' => 'Incorrect email'], 401);
            }

            if (!Hash::check($validated['password'], $user->password)) {
                return response()->json(['success' => false, 'err_msg' => 'Incorrect password'], 401);
            }


            $token = JWTAuth::fromUser($user);

            return response()->json(['success' => true, 'token' => $token, 'user' => $user], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'err_msg' => collect($e->errors())->first()[0]
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to log in', 'error' => $e->getMessage()], 500);
        }
    }


    public function register(AuthRequest $request)
    {
        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(['success' => true, 'token' => $token, 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'err_msg' => 'Failed to signup', 'error' => $e->getMessage()], 500);
        }
    }
}
