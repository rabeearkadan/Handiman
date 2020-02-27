<?php

namespace App\Models;

use App\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;

class RequestService extends Model
{
    //
    protected $table='requests';

    public function users(){
        return $this->belongsToMany(User::class);
    }

}
