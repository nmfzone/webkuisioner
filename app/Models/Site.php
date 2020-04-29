<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'domain', 'welcome_message', 'privacy_policy',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'site_participant', 'site_id', 'participant_id');
    }
}
