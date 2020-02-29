<?php

namespace App\Models;

use App\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Service extends Eloquent
{
    //
    protected $table = "services";

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
