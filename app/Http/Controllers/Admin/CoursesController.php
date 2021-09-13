<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Lecture;
use App\Models\Attachment;
use App\Http\Requests\Admin\Courses\CourseRequest;
use App\Http\Requests\Admin\Courses\CourseLectureRequest;
use App\Http\Requests\Admin\Courses\LectureMediaRequest;
class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.list',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course;
        $exams  = Exam::pluck('title','id');
        return view('admin.courses.form',compact('course','exams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {

        $request->merge(['on' => $request->on ? 1 : 0]);
        if($course = Course::create($request->validated())) {
            Exam::whereIn('id',$request->exams)->update(['course_id' => $course->id]);
            return redirect()->route('admin.courses.index')->with(['success' => ' تم اضافه الكورس  بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $exams  = Exam::pluck('title','id');
        return view('admin.courses.form',compact('course','exams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request,Course $course)
    {
        if($course->update($request->validated())) {
            Exam::whereIn('id',$request->exams)->update(['course_id' => $course->id]);
            return redirect()->route('admin.courses.index')->with(['success' => ' تم تعديل الكورس  بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->exams()->deatch();
        if($course->delete()) {
            return redirect()->back()->with(['success' => ' تم حذف الكورس بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }


    public function get_course_lecture(Course $course) {
        $lectures = $course->lectures()->orderby('order','asc')->get();

        $lectures->load(['attachments'=>function($q){
                    $q->orderby('order','asc');
        }]);

        return response()->json(['lectures' => $lectures], 200);
    }



    public function add_lecture(CourseLectureRequest $request) {
        $course = Course::find($request->course_id);
        if(!$course) {
            return response()->json(['error' => 'course not found'], 500);
        }
        $lecture = $course->lectures()->create($request->validated());
        return response()->json(['lecture' => $lecture], 200);
    }



    public function edit_lecture(CourseLectureRequest $request,Lecture $lecture){
        $lecture->update($request->validated());
        return response()->json(['lecture' => $lecture->load('attachments')], 200);
    }


    public function delete_lecture(Lecture $lecture){
        $lecture->delete();
        return response()->json(['id' => $lecture->id], 200);
    }

    public function add_lecture_media(LectureMediaRequest $request,Lecture $lecture){
        $media = $lecture->attachments()->create($request->validated());
        return response()->json(['media' => $media], 200);
    }


    public function edit_lecture_media(LectureMediaRequest $request,Lecture $lecture,Attachment $attachment){
        if($lecture->attachments()->find($attachment)){
            $attachment->update($request->validated());
            return response()->json(['lecture_id' => $lecture->id,'attachment' => $attachment], 200);
        }
    }


    public function delete_lecture_media(Lecture $lecture,Attachment $attachment){
        if($lecture->attachments()->find($attachment)){
            $attachment->delete();
            return response()->json(['lecture_id' => $lecture->id, 'attachment_id' => $attachment->id], 200);
        }
    }


    public function update_lectures_order(Request $request) {
        foreach ($request->lectures as $lecture) {
            Lecture::where('id',$lecture['id'])->update(['order'=>$lecture['order']]);
        }
    }

    public function update_lecture_attachment_order(Request $request) {
        foreach ($request->attachements as $attachement) {
            Attachment::where('id',$attachement['id'])->update(['order'=>$attachement['order']]);
        }
    }





}
