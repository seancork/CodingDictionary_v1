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

        if($type == "up"){
             Votes::where('word_id',$get_id)
                ->where('user_id',\Auth::user()->id)->update(['deleted'=> 0, 'vote_type' => 1]);
        }elseif($type == "down"){
            Votes::where('word_id',$get_id)
                ->where('user_id',\Auth::user()->id)->update(['deleted'=> 0, 'vote_type' => 0]);
        }
                   $up_count = Votes::where('vote_type','=','1')
                                  ->where('deleted','=','0')
                                  ->where('word_id','=',$get_id)->count();

                    $down_count = Votes::where('vote_type','=','0')
                                  ->where('deleted','=','0')
                                  ->where('word_id','=',$get_id)->count();
                   
        Word::where('id',$get_id)->update(['vote_cache'=>  $up_count - $down_count]);
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
         }else{
      return  response()->json(['failed' => 'failed'], 404);
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
             $type =  preg_replace("/[^a-zA-Z]+/", "", $request->word_id);
         
          if (Votes::where('word_id', '=', $get_id)
                            ->where('deleted', '=', 0)
                            ->where('user_id', '=', \Auth::user()->id)->exists()) {

            Votes::where('word_id',$get_id)
                    ->where('user_id',\Auth::user()->id)->update(['deleted'=> 1]);
          
                $up_count = Votes::where('vote_type','=','1')
                                  ->where('deleted','=','0')
                                  ->where('word_id','=',$get_id)->count();

                $down_count = Votes::where('vote_type','=','0')
                                  ->where('deleted','=','0')
                                  ->where('word_id','=',$get_id)->count();

            Word::where('id',$get_id)->update(['vote_cache'=>  $up_count - $down_count]);
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
