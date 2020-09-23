@extends('admin.layouts.master')
@push('extra-css')
<link rel="stylesheet" href="{{ asset('css/datetimepicker.min.css') }}">
@endpush
@section('content')
<div class="col-md-12">
    @include('admin.layouts.components.alerts')


<form role="form" enctype="multipart/form-data" action="{{ $exam->id ? route('admin.exams.update',$exam->id) : route('admin.exams.store') }}" method="POST">
    <div class="card-body">
    @csrf
    @if($exam->id)
        @method('put')
    @endif
    <div class="form-row">


        <div class="form-group col-md-3">
            <label for="title">العنوان</label>
            <input type="text" name="title" value="{{ old_value($exam,'title') }}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="ادخل العنوان">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group col-md-3">
            <label for="doctor">الدكتور</label>
            <input type="text" name="doctor" value="{{ old_value($exam,"doctor") }}" class="form-control @error("doctor") is-invalid @enderror" id="doctor" placeholder="ادخل اسم الدكتور">
            @error("doctor")
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group col-md-3">
            <label for="started_at">تاريخ بدء الامتحان</label>
            <input type="text" name="started_at" value="{{ old_value($exam,"started_at") }}" class="form-control @error("started_at") is-invalid @enderror" id="started_at" placeholder="ادخل تاريخ الامتحان">
            @error("started_at")
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>


          <div class="form-group col-md-3">
            <label for="ended_at">تاريخ نهاية الامتحان</label>
            <input type="text" name="ended_at" value="{{ old_value($exam,"ended_at") }}" class="form-control @error("ended_at") is-invalid @enderror" id="ended_at" placeholder="ادخل ناريخ نهايه الامتحان">
            @error("ended_at")
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>


          <div class="form-check mt-4 mr-3">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label for="exampleCheck1">مفعل</label>
          </div>

    </div><!-- form row -->



    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary float-left">ارسال</button>
    </div>
  </form>


  @if($exam->id)
  <div id="app">
    <exam-questions :id="{{ $exam->id }}"></exam-questions>
  </div>
  @endif
</div>



@endsection

@push('extra-js')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/datetimepicker.full.min.js') }}"></script>
@endpush

@section('extra-scripts')
<script>
    $('#started_at,#ended_at').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
    });
</script>
@endsection
