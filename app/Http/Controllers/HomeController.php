<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    // If this class is used, you must be logged in user to see any page within this controller.
    public function __construct()
    {
        $this->middleware('auth');
    }
 */

    /**
     * HomePage controller
     *
     * @return \Illuminate\Http\Response
     */
    public function index_recent_words()
    {
        $recent_words = Word::orderBy('created_at','word_id')->take(10)->get()->reverse();

          return view('welcome',compact('recent_words'));
    }
}
