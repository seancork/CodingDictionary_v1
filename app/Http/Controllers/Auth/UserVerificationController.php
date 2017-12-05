<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class UserVerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | userverified
    |--------------------------------------------------------------------------
    |
    | This is to verify the users email address
    |
    */

    public function userVerified($token)
    {
        $check = DB::table('user_verified')->where('token',$token)->first();

        if(!is_null($check)){
            $user = User::find($check->id_user);

            if($user->is_activated == 1){
                return redirect()->to('login')
                    ->with('success',"Email already verified.");                
            }

            $user->update(['is_verified' => 1]);
            DB::table('users_verification')->where('token',$token)->delete();

            return redirect()->to('login')
                ->with('success',"Email successfully verified.");
        }

        return redirect()->to('login')
                ->with('warning',"your token is invalid.");
    }
}
