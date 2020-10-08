<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultQuestion extends Model
{
    use HasFactory;
    protected $table = "results_questions";
    protected $fillable = ['question_id','exam_id','answer_id','degree','right'];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
