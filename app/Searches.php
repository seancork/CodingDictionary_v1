<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Searches extends Model
{
        protected $fillable = [
        'searched', 'if_exists',
    ];
}
