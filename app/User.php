<?php

namespace App;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class User extends Eloquent implements
    AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'api_token', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'device_token', 'device_platform'
    ];
//was hidden and I remove it
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isClient()
    {
        return $this->role == 'user' || $this->role == 'user_employee';
    }

    public function isHandyman()
    {
        return $this->role == 'employee' || $this->role == 'user_employee';
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function service()
    {
        return $this->belongsToMany(Service::class);
    }
    public function posts(){
        return $this->belongsToMany(Post::class);
    }



}
