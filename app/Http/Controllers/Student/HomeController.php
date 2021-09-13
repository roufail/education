<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\ResultQuestion;
class HomeController extends Controller
{
    public function home() {
        $courses = Course::query();
        if(request()->s){
          $courses = $courses->where('title','like','%'.request()->s.'%');
        }
        $courses = $courses->withCount('students')->paginate(10);
        return view('student.frontend.home',compact('courses'));
    }

    public function get_course(Course $course){
        $enrolled = false;
        if(auth('students')->check()) {
         $enrolled = auth('students')->user()->courses->contains($course);
        }

        $course->load(['exams.result' => function($res){
            $res->where('student_id',auth('students')->user()->id);
        },'exams.questions']);

        $total = $course->exams->sum(function($exam){
            return $exam->questions->sum('degree');
        });

        $degree = $course->exams->sum(function($exam){
            return $exam->result ? $exam->result->sum('degree') : 0;
        });

        $degree = ResultQuestion::whereIn('exam_id',$course->exams->pluck('id'))->where('student_id',auth('students')->user()->id)->sum('degree');

        return view('student.frontend.course',compact('course','enrolled','total','degree'));
    }


    public function course_enroll(Course $course){
        auth('students')->user()->courses()->attach($course);
        return redirect()->route('student.course',$course->id);
    }

    public function my_courses(){
        $courses = auth('students')->user()->courses()->withCount('students')->paginate(10);
        return view('student.frontend.home',compact('courses'));
    }


    public function get_lecture(Course $course,Lecture $lecture){

        if($course->lectures->contains($lecture) && auth('students')->user()->courses->contains($course)){


            $lecture->load(['attachments' => function($attach){
                    $attach->orderby('order');
            }]);

            return view('student.frontend.lecture',compact('lecture'));
        }else {
            abort(404);
        }
    }
}
