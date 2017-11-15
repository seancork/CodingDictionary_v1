<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class AdminController extends Controller
{
    public function admin_main()
    {

    //  $count_users = User::table('user')->count()	  
       
            return view('admin_main',compact('count_users'));
}
}
