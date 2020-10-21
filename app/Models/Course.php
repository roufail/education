<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','image','exam_id'];

    public function exams()
    {
        return $this->hasMany(Exam::class)->where('on',1);
    }

    public function result()
    {
        return $this->belongsTo(Result::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function setImageAttribute($value) {
        $image = request()->image->store('/','courses');
        $this->attributes['image'] = $image;
    }

}
