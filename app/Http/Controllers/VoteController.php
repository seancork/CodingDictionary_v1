<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Votes;
use App\Word;
use Cookie;
use Auth;

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

             if($type == "up"){   
            $save_vote = new Votes; 
            $save_vote->word_id = $get_id;
            $save_vote->deleted = 0;
            $save_vote->vote_type =  1;
            $save_vote->save();
           
           Word::where('id',$get_id)->increment('vote_cache');
        }elseif($type == "down"){
            $save_vote = new Votes;
            $save_vote->word_id = $get_id;
            $save_vote->deleted = 0;
            $save_vote->user_id = \Auth::user()->id;
            $save_vote->vote_type =  0;
            $save_vote->save();

            Word::where('id',$get_id)->decrement('vote_cache');
         }else{
            //notting to see here
         }
//******** create cookie, update cookie, delete values. ******//
if(Cookie::get('been_clicked') == null){
$convert = json_encode(array($request->word_id));
Cookie::queue('been_clicked', $convert, 2628000);
}else{
$decode_cookie = json_decode(Cookie::get('been_clicked'));

$add_value = array_merge($decode_cookie,array($request->word_id));

$convert = json_encode($add_value);//cookie needs string, so covert from array to string.
Cookie::queue('been_clicked', $convert, 2628000);
//******** end cookie stuff ******//
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
