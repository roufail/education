@extends('layouts.master')

@section('title',$lecture->title)



@section('content')

<div class="content col-12">
    <div>
        <h4 class="course-title">{{ $lecture->title }}</h4>
        <p class="pull-left"><a href="{{ route('student.course',$lecture->course->id) }}">الرجوع للكورس</a></p>



        @foreach ($lecture->attachments->filter(function($att){ return $att->lecture;}) as $attachment)
        <iframe width="100%" height="600px" src="{{ $attachment->link }}" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        @endforeach




        @if($lecture->attachments->filter(function($att){ return !$att->lecture;})->count() > 0)
        <table class="table content-table c">
            <thead>
                <tr>
                    <th scope="col">الملف</th>
                    <th scope="col">نوعه</th>
                    <th scope="col">تحميل</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($lecture->attachments->filter(function($att){ return !$att->lecture;}) as $attachment) <tr>
                    <th scope="row">{{ $attachment->title }}</th>
                    <td>{{ $attachment->type }}</td>
                    <td><a target="_blank" href="{{ $attachment->link }}">تحميل</a></td>
                </tr>
                @endforeach


            </tbody>
        </table>
        @endif


    </div>

</div>
@endsection
