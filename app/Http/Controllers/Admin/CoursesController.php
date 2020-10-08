<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Exam;
use App\Http\Requests\Admin\Courses\CourseRequest;

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
        if(Course::create($request->validated())) {
            return redirect()->route('admin.courses.index')->with(['success' => ' تم اضافه الكورس  بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        if($course->delete()) {
            return redirect()->back()->with(['success' => ' تم حذف الكورس بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }
}
