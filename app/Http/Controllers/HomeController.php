<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;

class HomeController extends Controller
{
    /**
     * HomePage controller
     *
     * @return \Illuminate\Http\Response
     */
    public function index_recent_words()
    {     
    $recent_words = Word::select('word','created_at')
                   ->orderBy('created_at','word_id')    
                   ->where('status', '=', 1)
                   ->distinct()
                   ->take(5)
                   ->get();

          return view('welcome',compact('recent_words'));
    }
}
