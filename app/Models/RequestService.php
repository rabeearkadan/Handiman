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

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
