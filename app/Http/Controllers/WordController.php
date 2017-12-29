<?php

namespace App\Http\Controllers;
use App\Word;
use App\UserSavedWords;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_word(Request $request)
    {
     $validator = Validator::make($request->all(), [
 'word' => 'required|regex:/^[\pL\s\-]+$/u|min:1|max:191',
        'desc' => 'required|min:1|max:255',
    ]);

    if ($validator->fails()) {
            return redirect('/add')
                        ->withErrors($validator)
                        ->withInput();
    }else{
    $add = new Word;
    $add->word = $request->word;
    $add->description = $request->desc;
    $add->status = 0;  //0 = waiting to be approved/disproved | 1 = disproved | 2 = approved
    $add->user_id = \Auth::user()->id;
    $add->vote_cache = 0;
    $add->save();
    }
    return view('word_successful');
  }

     public function add()
    {
        return view('add');
    }

  public function save_word(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'word_id' => 'required|min:1|max:10',
        ]);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
          if (UserSavedWords::where('word_id', '=', $request->word_id)
                            ->where('user_id', '=', \Auth::user()->id)->exists()) {
             
             //if word_id already exists for this user, update deleted column
                UserSavedWords::where('word_id',$request->word_id)
                              ->where('user_id',\Auth::user()->id)->update(['deleted'=> 0]);
         
          response()->json(['success' => 'success'], 200);
        }else{
          $save_word = new UserSavedWords;
            $save_word->word_id = $request->word_id;
            $save_word->deleted = 0;
            $save_word->user_id = \Auth::user()->id;
            $save_word->save();
         response()->json(['success' => 'success'], 200);
        }}}

     public function remove_word(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'word_id' => 'required|min:1|max:10',
        ]);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
          UserSavedWords::where('word_id', '=', $request->word_id)
          ->where('user_id',\Auth::user()->id)
          ->update(['deleted'=> 1]);
         response()->json(['success' => 'success'], 200);
        }
    }

     public function get_all_terms(){
        $all_words = Word::select('word')->groupBy('word')->paginate(20);
 
        return view('all_terms',compact('all_words'));
}}
