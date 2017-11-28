<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\UserSavedWords;
use App\Word;
use Response;

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
}}