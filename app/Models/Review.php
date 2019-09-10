<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    

    public function vacation()
    {
        return $this->hasOne('App\Models\Vacation');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
