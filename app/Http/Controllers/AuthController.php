<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt($request->only('email', 'password'))){
            $user = User::where('id', Auth::user()->id)->first();

            if(Auth::user()->role_id == 1){
                $token = $user->createToken("TokenAdmin")->plainTextToken;

                return response()->json([
                    'message' => 'Successful login as a admin',
                    'user' => $user,
                    'token' => $token
                ], 200);
            }else if(Auth::user()->role_id == 2){
                $token = $user->createToken("TokenUser")->plainTextToken;

                return response()->json([
                    'message' => 'Successful login as a user',
                    'user' => $user,
                    'token' => $token
                ], 200);
            }
        }else{
            return response()->json([
                'message' => 'Username or Password is wrong'
            ], 400);
        }
    }
    public function register(Request $request){
        $request->validate([
            "name" => "required",
            "username" => "required",
            "email" => "required|email",
            "password" => "required|min:8"
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2
        ]);
        return response()->json([ 
            'message' => 'Successful registration',
            'data_student' => $user,
        ], 200);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successful logout'
        ], 200);
    }
}
