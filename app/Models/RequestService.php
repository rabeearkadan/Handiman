<?php

namespace App\Models;

use App\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class RequestService extends Eloquent
{
    //
    protected $table = 'requests';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function employees()
    {
        return $this->belongsToMany(
            User::class, null, 'employee_ids', 'employee_request_ids'
        );
    }
    public function clients()
    {
        return $this->belongsToMany(
            User::class, null, 'client_request_ids', 'client_ids');
    }

}
