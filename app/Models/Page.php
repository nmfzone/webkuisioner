<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'order', 'allow_previous', 'allow_next',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
