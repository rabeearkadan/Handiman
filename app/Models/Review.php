<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //contains rating and reviews
    //each review is related to a job(done)/employee/client
    public function employee(){
        return $this->belongsTo(User::class , 'employee_id');
    }
    public function client(){
        return $this->belongsTo(User::class , 'client_id');
    }
}
