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
    public function ServiceArray()
    {
        return [
            '_id' => $this->_id,
            'name' => $this->name,
            'image' => $this->image,
            'indicator'=>$this->indicator,
        ];
    }


}
