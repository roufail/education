@extends('layouts.master')

@section('title',$exam->title)

@push('extra-css')
<link rel="stylesheet" href="{{ asset('css/exams.css') }}">
@endpush


@section('content')
<div id="app" class="col-12">
    <student-exam :id="{{ $exam->id }}"></student-exam>
</div>

@endsection

@push('extra-js')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/datetimepicker.full.min.js') }}"></script>
@endpush
