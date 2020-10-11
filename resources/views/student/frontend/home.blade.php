@extends('layouts.master')

@section('title','Home page')



@section('content')
@foreach ($courses as $course)
@include('student.layouts.components.course',['course' => $course])
@endforeach
@endsection
