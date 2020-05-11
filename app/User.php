<?php

namespace App;

use App\Models\Invoice;
use App\Models\Post;
use App\Models\RequestService;
use App\Models\Service;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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


    protected $casts = [
        'email_verified_at' => 'datetime',

    ];
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

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }


    public function employeeRequests()
    {
        return $this->belongsToMany(
            RequestService::class, null, 'employee_ids', 'employee_request_ids'
        );

    }

    public function clientRequests()
    {
        return $this->belongsToMany(
            RequestService::class, null, 'client_ids', 'client_request_ids'
        );
    }

    public function simplifiedArray()
    {
        return [
            '_id' => $this->_id,
            'name' => $this->name,
            'image' => $this->image,
        ];
    }

    /**
     * @inheritDoc
     */
    public function hasVerifiedEmail()
    {
        // TODO: Implement hasVerifiedEmail() method.
    }

    /**
     * @inheritDoc
     */
    public function markEmailAsVerified()
    {
        // TODO: Implement markEmailAsVerified() method.
    }

    /**
     * @inheritDoc
     */
    public function sendEmailVerificationNotification()
    {
        // TODO: Implement sendEmailVerificationNotification() method.
    }

    /**
     * @inheritDoc
     */
    public function getEmailForVerification()
    {
        // TODO: Implement getEmailForVerification() method.
    }
}
