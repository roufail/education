<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
class HomeController extends Controller
{
    public function home() {
        $courses = Course::query();
        if(request()->s){
          $courses = $courses->where('title','like','%'.request()->s.'%');
        }
        $courses = $courses->paginate(10);
        return view('student.frontend.home',compact('courses'));
    }

    public function get_course(Course $course){
        return view('student.frontend.course',compact('course'));
    }
}
