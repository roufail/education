@extends('admin.layouts.master')
@push('extra-css')
<link rel="stylesheet" href="{{ asset('css/datetimepicker.min.css') }}">
@endpush
@section('content')
<div class="col-md-12">
    @include('admin.layouts.components.alerts')


<form role="form" enctype="multipart/form-data" action="{{ $category->id ? route('admin.categories.update',$category->id) : route('admin.categories.store') }}" method="POST">
    <div class="card-body">
    @csrf
    @if($category->id)
        @method('put')
    @endif
    <div class="form-row">


        <div class="form-group col-md-3">
            <label for="category">العنوان</label>
            <input type="text" name="category" value="{{ old_value($category,'category') }}" class="form-control @error('category') is-invalid @enderror" id="category" placeholder="ادخل العنوان">
            @error('category')
                <small class="text-danger">{{ $message }}</small>
            @enderror
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


