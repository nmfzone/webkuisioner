<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function site()
    {
        return $this->hasOne(Site::class);
    }

    public function setEmailAttribute($value)
    {
        $email = explode('@', $value);

        $email[0] = preg_replace('/[^0-9A-Za-z]/', '', $email[0]);

        return implode('@', $email);
    }
}
