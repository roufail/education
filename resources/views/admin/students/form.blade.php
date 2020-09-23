@extends('admin.layouts.master')
@push('extra-css')
<link rel="stylesheet" href="{{ asset('css/datetimepicker.min.css') }}">
@endpush
@section('content')
<div class="col-md-12">
<form role="form" enctype="multipart/form-data" action="{{ $student->id ? route('admin.students.update',$student->id) : route('admin.students.store') }}" method="POST">
    <div class="card-body">
    @csrf
    @if($student->id)
        @method('put')
    @endif
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="name">الاسم</label>
        <input type="text" name="name" value="{{ old_value($student,'name') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="ادخل الاسم">
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group col-md-3">
        <label for="email">البريد الالكتروني</label>
        <input type="email" name="email"  value="{{ old_value($student,'email') }}"  class="form-control @error('email') is-invalid @enderror" id="email"  placeholder="ادخل البريد الالكتروني">
        @error('email')
          <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

      <div class="form-group col-md-3">
        <label for="mobile">رقم الموبايل</label>
        <input type="text" value="{{ old_value($student,'mobile') }}"  class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="ادخل رقم الموبايل">
        @error('mobile')
          <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

      <div class="form-group col-md-3">
        <label for="birthday">تاريخ الميلاد</label>
        <input type="text"  value="{{ old_value($student,'birthday') }}"  class="form-control @error('birthday') is-invalid @enderror" name="birthday" id="birthday" placeholder="ادخل تاريخ الميلاد">
        @error('birthday')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="form-group col-md-3">
        <label for="country">الدوله</label>
        <input type="text"  value="{{ old_value($student,'country') }}"  class="form-control @error('country') is-invalid @enderror" name="country" id="country" placeholder="ادخل الدوله">
        @error('country')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group col-md-3">
        <label for="state">المحافظه</label>
        <input type="text"  value="{{ old_value($student,'state') }}"  class="form-control @error('state') is-invalid @enderror" name="state" id="state" placeholder="ادخل المحافظه">
        @error('state')
        <small class="text-danger">{{ $message }}</small>
        @enderror
     </div>


      <div class="form-group col-md-3">
        <label for="job">الوظيفه</label>
        <input type="text" name="job"  value="{{ old_value($student,'job') }}"  class="form-control @error('job') is-invalid @enderror" id="job" placeholder="ادخل الوظيفه">
        @error('job')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

      <div class="form-group col-md-3">
        <label for="church">الكنيسة</label>
        <input type="text" value="{{ old_value($student,'church') }}"  class="form-control @error('church') is-invalid @enderror" id="church" name="church" placeholder="ادخل الكنيسه">
        @error('church')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

      <div class="form-group col-md-3">
        <label for="qualification">المؤهل</label>
        <input type="text"  value="{{ old_value($student,'qualification') }}"   class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification" placeholder="ادخل المؤهل">
        @error('qualification')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

      <div class="form-group col-md-9">
        <label for="exampleInputFile">الصوره</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="image" class="custom-file-input  @error('image') is-invalid @enderror" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile">اختار صوره</label>
          </div>
        </div>
        @error('image')
            <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>


    </div><!-- form row -->

    <div class="form-row">


      <div class="form-group col-md-4">
        <label for="password">كلمه السر</label>
        <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password" placeholder="ادخل كلمه السر">
        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

      <div class="form-group col-md-4">
        <label for="confrim_password">تأكيد كلمه السر</label>
        <input type="password" class="form-control  @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" placeholder="ادخل تاكيد كلمه السر">
        @error('confirm_password')
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
</div>
@endsection

@push('extra-js')
<script src="{{ asset('js/datetimepicker.full.min.js') }}"></script>
@endpush

@section('extra-scripts')
<script>
    $('#birthday').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
    });

</script>
@endsection
