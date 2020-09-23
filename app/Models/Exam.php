<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'title', 'doctor', 'started_at','ended_at'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function main_questions()
    {
        return $this->hasMany(MainQuestion::class);
    }
}
