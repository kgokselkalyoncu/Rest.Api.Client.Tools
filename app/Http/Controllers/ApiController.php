<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
//use Illuminate\Foundation\Auth\User;


class ApiController extends Controller
{
    //
    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            if($user instanceof \App\Models\User){
                $success['token'] = $user->createToken('login')->accessToken;
            }
            
            return response()->json(['success' => $success], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
