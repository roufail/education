<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id','main_question_id','question','degree','order','category_id','visible','notes'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
