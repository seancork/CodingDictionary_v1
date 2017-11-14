<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Word;
use App\UserSavedWords;
use App\Votes;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     
    public function __construct()
    {
        $this->middleware('auth');
    }

     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getTerm(Request $request)
    {
  //get keywords input for search
        $word=  \Request::get('w');
         $what_word1 = \Request::get('w');
        //search that student in Database
        // $student= Student::find($keyword);

           $what_word = Word::select('word', 'description','id','vote_cache')
                ->where('word', '=', $word)
                ->orderBy('vote_cache')
                ->paginate(10);
    if (Auth::check()) {
    $id_list = [];
       foreach($what_word as $indexKey => $word)
    {
      $id_list[] = $word->id;
    }
            $saved1 = UserSavedWords::select('id','word_id')
                ->where('user_id', '=', \Auth::user()->id)
                ->where('deleted', '=', 0)
                ->whereIn('word_id', $id_list)->get();
                   $saved = [];
       foreach($saved1 as $indexKey => $word){
         $saved[] = $word->word_id;
       }

       //***************************likes
        
    $id_list = [];
       foreach($what_word as $indexKey => $word)
    {
      $id_list[] = $word->id;
    }
            $saved1 = Votes::select('id','word_id','vote_type')
                ->where('user_id', '=', \Auth::user()->id)
                ->where('deleted', '=', 0)
                ->whereIn('word_id', $id_list)->get();
                   $votes = [];
       foreach($saved1 as $indexKey => $word){
         $votes[] =  $word->word_id;
       }
        return view('term',compact('what_word','what_word1','saved','votes','saved1'));
}else{
    
 return view('term',compact('what_word','what_word1','saved'));
}


}}
