<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'profile_url',
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

    public function participations()
    {
        return $this->belongsToMany(Site::class, 'site_participant', 'participant_id', 'site_id');
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = static::getPlainEmail($value);
    }

    public static function getPlainEmail($email)
    {
        $email = explode('@', Str::lower($email));

        $email[0] = preg_replace('/[^0-9A-Za-z]/', '', $email[0]);

        return implode('@', $email);
    }
}
