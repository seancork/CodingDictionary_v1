<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UserSavedWords;
use App\Word;
use App\User;
use Response;
use Mail;

class DashboardController extends Controller
{

    public function submitted_words()
    {
           $user_words = Word::select('word', 'description','status','id')
                ->where('user_id', '=', \Auth::user()->id)
                ->paginate(15);

          return view('submitted_words',compact('user_words'));
}

	 public function get_saved_words()
    {
    	  $saved_words = UserSavedWords::with('get_words')
            ->where('user_id', '=', \Auth::user()->id)
            ->where('deleted', '=', 0)->get();

            return view('home',compact('saved_words'));
}

 public function account()
    {
       $user = User::select('email', 'verified')->where('id', '=', \Auth::user()->id)->first();
        return view('account',compact('user'));
    }

       public function edit_account(Request $request)
    {
         $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255|unique:users',
    ]);

    if ($validator->fails()) {
            return redirect('/account')
                        ->withErrors($validator)
                        ->withInput();
    }else{
        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->verified = 0;
        $user->email_token = str_random(10);
         $user->update();
        
          $user = $user->toArray();
            Mail::send('emails.verification', $user, function($message) use ($user) {
                $message->to($user['email']);
                $message->subject('codingdictionary.com - Activation Code');
            });
     
                    return redirect()->route('account')
                        ->with('message', 'Updated Email, verified email has been sent.');
     }}
 public function resent_email()
 {
        $user = User::find(Auth::user()->id);
        $user->email_token = str_random(10);
         $user->update();
        
          $user = $user->toArray();
            Mail::send('emails.verification', $user, function($message) use ($user) {
                $message->to($user['email']);
                $message->subject('codingdictionary.com - Activation Code');
            });
     
                    return redirect()->route('account')
                        ->with('message', 'Verified email has been sent.');
     }
 }