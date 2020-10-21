@extends('layouts.master')

@section('title',$course->title)



@section('content')

<div class="content row">
    <div class="col-md-12">
        <h1 class="course-title">{{ $course->title }}</h1>
        <div class="course-image text-center">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item"><i class="fa fa-users"></i>&nbsp; {{ $course->students->count() }}</li>
            </ul>

            <img width="90%" src="{{ Storage::disk('courses')->url($course->image) }}" />
        </div>

        <p class="course-description">{{ $course->description }}</p>
    </div>
    <div class="content col-md-12">
        @if($course->lectures->count() > 0)
        <table class="table content-table c">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">المحاضره</th>
                    <th scope="col">الدكتور</th>
                    @if($enrolled)
                    <th scope="col">مشاهده المحتوي</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($course->lectures as $lecture)
                <tr>
                    <th scope="row">{{ $lecture->order }}</th>
                    <td>{{ $lecture->title }}</td>
                    <td>{{ $lecture->teacher }}</td>
                    @if($enrolled)
                    <td scope="col">
                        <a href="{{ route('student.course.lecture',[$course->id,$lecture->id]) }}">المحاضره</a>
                    </td>
                    @endif
                </tr>
                @endforeach


            </tbody>
        </table>
        @endif
        @php

        @endphp
        <div class="actions m-5 float-left">
            @if(!$enrolled)
            <a href="{{ route('student.course.enroll',$course->id) }}">الاشتراك</a>
            @else
            @if($course->exams->count())
            @foreach ($course->exams as $exam)
            <a href="{{ route('student.exam',$exam->id) }}">{{ $exam->title }}</a>@if($exam->result) (تم اجتياز هذا
            الامتحان بنسبه {{ $exam->result->percentage }}%)@endif<br />

            @endforeach
            @endif
            اجمالي الدرجات
            {{ $total }} <br />
            درجاتك
            {{ $degree }} <br />
            @endif
        </div>

    </div>
</div>
@endsection
