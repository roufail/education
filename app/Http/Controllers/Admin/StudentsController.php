<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\Admin\Students\StudentRequest;
class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->select(['id','image','name','email','mobile'])->paginate(10);
        return view('admin.students.list',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = new Student();
        return view('admin.students.form',compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        if(Student::create($request->validated())) {
            return redirect()->route('admin.students.index')->with(['success' => ' تم اضافه الطالب  بنجاح']);
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
    public function edit(Student $student)
    {
        return view('admin.students.form',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        if($student->update($request->validated())) {
            return redirect()->route('admin.students.index')->with(['success' => ' تم تعديل الطالب  بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if($student->delete()) {
            return redirect()->back()->with(['success' => ' تم حذف الطالب ' . $student->name. ' بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }
}
