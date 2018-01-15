<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Word;
use App\User;
use App\Searches;
use Response;

class DashboardAdminController extends Controller
{
    public function admin_main()
    {
     $count_users = User::count();
      $total_aproved_words = Word::where('status',1)->count();
     $searches = Searches::orderBy('created_at', 'created_at')->paginate(50);
            return view('admin_main',compact('count_users','searches','total_aproved_words'));
}

public function getIpAddress() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim(end($ipAddresses));
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

 public function words_check(Request $request)
     {
      $ip_test = $this->getIpAddress();
    	  $words = Word::select('word', 'description','id')
                ->where('status', '=', 0)->get();

            return view('words_check',compact('words','ip_test'));
}

 public function words_check_status(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'word_id' => 'required|min:1|max:10',
            'type' => 'required|alpha|min:1|max:4',
        ]);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
              $get_id = preg_replace("/[^0-9]/","",$request->word_id); 
           $type =  preg_replace("/[^a-zA-Z]+/", "", $request->type);
           if($type == "up"){
            Word::where('id',$get_id)->update(['status'=> 1]);//aproved
        }
          if($type == "down"){
             Word::where('id',$get_id)->update(['status'=> 2]); //disaproved
          }
    }}
}
