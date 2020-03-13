<?php

namespace App\Models;

use App\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Post extends Eloquent
{
    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function tags(){
        return $this->belongsToMany(Service::class);
    }



}
