<?php

namespace App\Models;

use App\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Post extends Eloquent
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title','body',
    ];
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function tags(){
        return $this->belongsToMany(Service::class);
    }



}
