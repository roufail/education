<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Student\VerifyEmail;
class Student extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','mobile','birthday','country','state','job','church','qualification','image'
    ];


    public function setImageAttribute($value) {
        $image = request()->image->store('/','users');
        $this->attributes['image'] = $image;
    }
    // public function setPasswordAttribute($value) {
    //     $this->attributes['password'] = bcrypt($value);
    // }


    public function sendEmailVerificationNotification() {
        $this->notify(new VerifyEmail);
    }


    public function results_questions()
    {
        return $this->hasMany(ResultQuestion::class);
    }


    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
