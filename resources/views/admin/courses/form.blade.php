@extends('admin.layouts.master')
@push('extra-css')
<link rel="stylesheet" href="{{ asset('css/datetimepicker.min.css') }}">
@endpush
@section('content')
<div class="col-md-12">
    {{-- @include('admin.layouts.components.alerts') --}}


    <form role="form" enctype="multipart/form-data"
        action="{{ $course->id ? route('admin.courses.update',$course->id) : route('admin.courses.store') }}"
        method="POST">
        <div class="card-body">
            @csrf
            @if($course->id)
            @method('put')
            @endif
            <div class="">


                <div class="form-group">
                    <label for="course">العنوان</label>
                    <input type="text" name="title" value="{{ old_value($course,'title') }}"
                        class="form-control @error('title') is-invalid @enderror" id="title" placeholder="ادخل العنوان">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">الوصف</label>
                    <textarea type="text" name="description"
                        class="form-control @error('description') is-invalid @enderror" id="description"
                        placeholder="ادخل الوصف">{{ old_value($course,'description') }}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exam_id">الامتحان</label>


                    <select name="exam_id" class="form-control">
                        <option value="">------</option>
                        @foreach ($exams as $id => $exam)
                        <option value="{{ $id }}" @if($id==$course->exam_id) selected="selected" @endif>{{ $exam }}
                        </option>
                        @endforeach
                    </select>


                    @error('exam_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div><!-- form row -->


            <div class="form-group col-md-9">
                <label for="exampleInputFile">الصوره</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input  @error('image') is-invalid @enderror"
                            id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">اختار صوره</label>
                    </div>
                </div>
                @error('image')
                <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-left">ارسال</button>
        </div>
    </form>


    @if($course->id)
    <div id="app">
        <course-content :id="{{ $course->id }}"></course-content>
    </div>
    @endif

</div>
@endsection


@push('extra-js')
<script src="{{ asset('js/app.js') }}"></script>
@endpush
