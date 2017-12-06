<?php

namespace App\Http\Controllers\Auth;

use DB;
use Mail;
use Session;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|alpha_dash|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
           'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(10),

        ]);
    }

       protected function registered(Request $request, $user)
    {
        $user = $user->toArray();
    
   Mail::send('emails.verification', $user, function($message) use ($user) {
                $message->to($user['email']);
                $message->subject('Site - Activation Code');
            }); 
    }

       public function verify($from_email){
        $myArray = explode('&', $from_email);
        
 $check_verified = User::select('verified')
 ->where('email',$myArray[1])
            ->first();
 if($check_verified->verified == 1){
    if($user = Auth::user()){
     return redirect('home')
       ->with('message', 'Your email has already been verified.');
}else{
        return redirect('login')
         ->with('message', 'Your email has already been verified.');
    } }else{
        try {
            User::where('email_token',$myArray[0])->
                  where('email',$myArray[1])
            ->firstOrFail()->verified();
    
}catch(\Exception $e){
    if($user = Auth::user())
{
     return redirect('home')
       ->with('message', 'Something went wrong :( Please try again.');
}else{
        return redirect('login')
        ->with('message', 'Something went wrong :( Please try again.');
    }  }

        if($user = Auth::user())
{
     return redirect('home')
         ->with('message', 'Email has been Verified.');
}else{
        return redirect('login')
         ->with('message', 'Email has been Verified.');
    }  
}}
}