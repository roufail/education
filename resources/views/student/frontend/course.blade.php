@extends('layouts.master')

@section('title',$course->title)



@section('content')
@if($course->exam->count())
<a href="{{ route('student.exam',$course->exam->id) }}">الامتحان</a>
@endif

@endsection
