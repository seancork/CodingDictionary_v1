<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User; 
use Validator;
use Response;


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

    public function verify($token, $email){
          $validator = Validator::make( 
        [
            'email' => $email,
            'token' => $token,
          ],

            [
            'email' => 'required|string|email|max:255',
            'token' => 'required|alpha_num|min:1|max:10',
        ]);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
        $check_verified = User::select('verified')->where('email',$email)->first();
    
    if($check_verified->verified == 1){
    if($user = Auth::user()){
     return redirect('home')->with('message', 'Your email has already been verified.');
    }else{
        return redirect('login')
         ->with('message', 'Your email has already been verified.');
    }}else{
        try {
            User::where('email_token',$token)->
                  where('email',$email)->firstOrFail()->verified();
    
}catch(\Exception $e){
    if($user = Auth::user()){
     return redirect('home')->with('message', 'Something went wrong :( Please try again.');
}else{
    return redirect('login')
        ->with('message', 'Something went wrong :( Please try again.');
    }}
        if($user = Auth::user()){
     return redirect('home')->with('message', 'Email has been Verified.');
}else{
        return redirect('login')->with('message', 'Email has been Verified.');
      }  
   }}
  }
}