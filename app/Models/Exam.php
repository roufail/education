<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'title', 'doctor', 'started_at','ended_at','on'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function main_questions()
    {
        return $this->hasMany(MainQuestion::class)->orderBy('order','asc');
    }

    public function questions_answers()
    {
        return $this->hasMany(ResultQuestion::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }


}
