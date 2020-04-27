<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'text', 'data',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function answerers()
    {
        return $this->belongsToMany(User::class, 'question_answerer', 'question_id', 'participant_id');
    }
}
