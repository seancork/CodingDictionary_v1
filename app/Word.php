<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
     //   public $timestamps = false;

        protected $fillable = [
        'word', 'description', 'user_id','vote_cache',
    ];
}
