<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;

use App\Votes;
use App\Word;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function vote_word(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'word_id' => 'regex:/(^[A-Za-z0-9-]+$)+/|required|min:1|max:14',
        ]);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $get_id = preg_replace("/[^0-9]/","",$request->word_id); 
            $type =  preg_replace("/[^a-zA-Z]+/", "", $request->word_id);
          if (Votes::where('word_id', '=', $get_id)
                            ->where('user_id', '=', \Auth::user()->id)->exists()) {
             
             //if word_id already exists for this user, update deleted column
            if($type == "up"){
                $getvotetypeVotes = Votes::select('vote_type', 'deleted')
                ->where('word_id', '=', $get_id)->first();

                Votes::where('word_id',$get_id)
                    ->where('user_id',\Auth::user()->id)->update(['deleted'=> 0, 'vote_type' => 1]);

            if($getvotetypeVotes->vote_type == 0 && $getvotetypeVotes->deleted == 0){
                   Word::where('id',$get_id)->increment('vote_cache', 2);
                 }
         elseif($getvotetypeVotes->deleted == 1){
                     Word::where('id',$get_id)->increment('vote_cache', 1);
                   }
                }elseif($type == "down"){
                $getvotetypeVotes = Votes::select('vote_type', 'deleted')
                ->where('word_id', '=', $get_id)->first();

                  Votes::where('word_id',$get_id)
                    ->where('user_id',\Auth::user()->id)->update(['deleted'=> 0, 'vote_type' => 0]);
    if($getvotetypeVotes->vote_type == 1 && $getvotetypeVotes->deleted == 0){
                     Word::where('id',$get_id)->decrement('vote_cache', 2);
                   }
     elseif($getvotetypeVotes->deleted == 1){
                     Word::where('id',$get_id)->decrement('vote_cache', 1);
                   }

                }else{
                     response()->json(['error' => 'error'], 404);
                }
         
          response()->json(['success' => 'success'], 200);
        }else{
             if($type == "up"){
          $save_vote = new Votes;
            $save_vote->word_id = $get_id;
            $save_vote->deleted = 0;
            $save_vote->user_id = \Auth::user()->id;
            $save_vote->vote_type =  1;
             $save_vote->save();
           
           Word::where('id',$get_id)->increment('vote_cache');

              response()->json(['success' => 'success'], 200);

        }elseif($type == "down"){
             $save_vote = new Votes;
            $save_vote->word_id = $get_id;
            $save_vote->deleted = 0;
            $save_vote->user_id = \Auth::user()->id;
            $save_vote->vote_type =  0;
             $save_vote->save();

            Word::where('id',$get_id)->decrement('vote_cache');

             response()->json(['success' => 'success'], 200);
         }else{
        response()->json(['failed' => 'failed'], 404);
         }}}}

    public function delete_liked(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'word_id' => 'regex:/(^[A-Za-z0-9-]+$)+/|required|min:1|max:14',
        ]);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
              $get_id = preg_replace("/[^0-9]/","",$request->word_id); 
          if (Votes::where('word_id', '=', $get_id)
                            ->where('user_id', '=', \Auth::user()->id)->exists()) {
             Votes::where('word_id',$get_id)
                    ->where('user_id',\Auth::user()->id)->update(['deleted'=> 1]);
           $type =  preg_replace("/[^a-zA-Z]+/", "", $request->word_id);
           if($type == "up"){
            Word::where('id',$get_id)->decrement('vote_cache');
        }
          if($type == "down"){
             Word::where('id',$get_id)->increment('vote_cache');
          }
    }}}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
