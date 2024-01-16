<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetController extends Controller
{
    public function ResetPassword(ResetRequest $request)
    {
        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $emailcheck = DB::table('password_reset_tokens')->where('email', $email)->first();
        $token = DB::table('password_reset_tokens')->where('token', $token)->first();
        
        if(!$emailcheck){
            return response([
                'message' => 'Email not found',
            ], 401);
        }

        if(!$token){
            return response([
                'message' => 'Pin Code Invalid',
            ], 401);
        }

        DB::table('users')->where('email', $email)->update(['password' => $password]);//mise a jour de passeword dans la table users
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return response([
            'message' => 'Password change Successfully',
        ], 200);
    }
}
