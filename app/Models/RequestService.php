<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;


class RequestService extends Model
{


    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function employee(){
        return $this->belongsTo(User::class , 'employee_id');
    }
    public function client(){
        return $this->belongsTo(User::class , 'client_id');
    }
}
