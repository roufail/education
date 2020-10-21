<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['title','link','type','lecture','course_id','lecture_id'];
    protected $casts = ['lecture' => 'boolean'];
    use HasFactory;
}
