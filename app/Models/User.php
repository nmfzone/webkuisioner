<?php

namespace App\Models;

use App\Garages\Database\Concerns\SerializeEmail;
use App\Notifications\Auth\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,
        SerializeEmail;

    protected $fillable = [
        'name', 'email', 'password', 'profile_url', 'phone',
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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(mb_strtolower($value));
    }

    public function setPhoneAttribute($value)
    {
        $value = preg_replace('/[^0-9]/', '', $value);

        $this->attributes['phone'] = $value;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = static::serializeEmail($value);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
