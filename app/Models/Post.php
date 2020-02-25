<?php

namespace App\Models;

use App\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Post extends Eloquent
{
    //
    public function users(){
        return $this->belongsTo(User::class);
    }

}
