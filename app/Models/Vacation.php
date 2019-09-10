<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{

    // define that a Vacation has a One-To-Many relationship with Review.
    // Eloquent will automatically take the name 'review' and suffix it with '_id' to
    // determine the proper foreign key
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
