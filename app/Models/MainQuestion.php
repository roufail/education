<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['exam_id','question','notes'];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
