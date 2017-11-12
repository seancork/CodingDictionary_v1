<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSavedWords;

class DashboardController extends Controller
{
	 public function get_saved_words()
    {

    	  $saved_words = UserSavedWords::with('get_words')
 ->where('user_id', '=', \Auth::user()->id)
                ->where('deleted', '=', 0)
                ->get();

            return view('home',compact('saved_words'));
}
}