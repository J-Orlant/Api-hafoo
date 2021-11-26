<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileApiController extends Controller
{
    public function update(Request $request, User $user){
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'min:8',
        ];

        $data = $request->validate($rules);
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        return response()->json([
            'message' => 'User profile successfuly updated',
            'data' => $user
        ], 200);
    }
}
