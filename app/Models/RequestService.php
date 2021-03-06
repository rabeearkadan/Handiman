<?php

namespace App\Models;

use App\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class RequestService extends Eloquent
{
    //
    protected $table = 'requests';

    protected $casts = [
        'date' => 'datetime', 'rescheduled_date' => 'datetime'

    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function employees()
    {
        return $this->belongsToMany(
            User::class, null, 'employee_request_ids', 'employee_ids');
    }

    public function clients()
    {
        return $this->belongsToMany(
            User::class, null, 'client_request_ids', 'client_ids'
        );
    }

}
