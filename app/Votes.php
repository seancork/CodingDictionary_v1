<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
     protected $table = 'votes';

    protected $fillable = ['user_id','word_id','vote_type','deleted',];
}
