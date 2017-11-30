<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSavedWords extends Model
{
       // public $timestamps = false;

        protected $fillable = [
        'user_id', 'word_id', 'deleted',
    ];

    public function get_words(){
    	    return $this->belongsTo(Word::class, 'word_id');
    }
}
