<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'site_participant', 'package_id', 'participant_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
