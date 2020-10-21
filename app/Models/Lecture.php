<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = ['title','teacher','serial'];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
