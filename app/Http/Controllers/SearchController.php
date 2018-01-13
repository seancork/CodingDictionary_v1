<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Word;
use App\UserSavedWords;
use App\Searches;
use App\Votes;
use Response;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
  **/
    public function index(){
        return view('home');
    }

     public function search_front(Request $request){
         if (!empty($request->w)) {
       $get_word = Word::where('word', '=', $request->w)->first();
 
       if( (empty($get_word))) { 
          $term_saved = new Searches;
            $term_saved->searched = $request->w;
            $term_saved->if_exists = 0;
            $term_saved->searched_by = 1; //1 = searchbar on main page was used
            $term_saved->save();
          }elseif((!empty($get_word))){
            $term_saved = new Searches;
            $term_saved->searched = $request->w;
            $term_saved->if_exists = 1;
             $term_saved->searched_by = 1; //1 = searchbar on main page was used
            $term_saved->save();
          }else{
          //notting
          }
  return redirect()->route('term', ['w'=>$request->w]);
    }else{
  return redirect('all_terms');
    }}

    public function getTerm(Request $request){
        $word=   strip_tags(\Request::get('w'));
         $what_word1 =  strip_tags(\Request::get('w'));
       
         if (!empty($word)) {
           $what_word = Word::select('word', 'description','id','vote_cache')
           ->where('word', '=', $word)
                ->where('status', '=', 1)
                  ->orderBy('vote_cache', 'status')
                ->paginate(10);

    if (Auth::check()) {
    $id_list = [];
       foreach($what_word as $indexKey => $word){
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

    $id_list = [];
       foreach($what_word as $indexKey => $word){
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

}else{
  return redirect('all_terms');
}
}

//Add word page - this checked if the term already exists or not.
 public function live_search_add(Request $request){
    $get_word = Word::where('word', '=', $request->search)->first();
    if( (empty($get_word))) { 
   return "new";
    }else{
     return "exists";
    }}
}
