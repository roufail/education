<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','image','exam_id'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }


    public function setImageAttribute($value) {
        $image = request()->image->store('/','courses');
        $this->attributes['image'] = $image;
    }

}
