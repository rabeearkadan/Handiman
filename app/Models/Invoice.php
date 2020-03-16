<?php

namespace App\Models;

use App\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Invoice extends Eloquent
{
    //
    //payment method
    // request
    // location
    //employee
    //stuff
    //client
    public function users(){
        $this->belongsToMany(User::class);
    }
}
