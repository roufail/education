@extends('admin.layouts.master')


@section('content')
    <div class="col-lg-12">

        @include('admin.layouts.components.alerts')

        <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">الطلاب</h5>

            <div class="card-tools float-left">
                <a href="{{ route('admin.students.create') }}"><i class="fa fa-plus"></i></a>
            </div>

        </div>
        <div class="card-body">
        @if ($students->count() > 0)
        <table class="table table-bordered">
            <tbody>
            <tr>
              <th style="width: 10px">#</th>
              <th>الصوره</th>
              <th>الاسم</th>
              <th>البريد الالكتروني</th>
              <th>خيارات</th>
            </tr>
            @foreach ($students as $student)
                <tr>
                   <td>
                       {{ $loop->iteration }}
                   </td>
                   <td>
                       <img height="150px" width="150px" src="{{ Storage::disk('users')->url($student->image) }}">
                   </td>

                   <td>
                    {{ $student->name }}
                   </td>

                    <td>
                        {{ $student->email }}
                    </td>
                    <td>

                        <div class="float-right">
                            <a href="{{ route('admin.students.edit',$student->id) }}"><i
                                    class="fa fa-edit"></i>&nbsp;تعديل</a>
                        </div>

                        <div class="float-right mr-3">
                            <form style="display:inline-flex" method="post"
                                action="{{ route('admin.students.destroy',$student->id) }}">
                                @csrf
                                @method('delete')
                                <a class="delete-btn" href="javascript:;"><i
                                        class="fa fa-trash"></i>&nbsp;حذف</a>
                            </form>
                        </div>



                    </td>
                </tr>
            @endforeach
          </tbody>

        </table>
        @else
            there is no students
        @endif






        </div><!-- card body -->


        <div class="card-footer clearfix">
            {{ $students->render('admin.layouts.components.pagination') }}
        </div>

        </div>
    </div>
@endsection




@section('extra-scripts')
<script>
    jQuery(function($){
        $('.delete-btn').click(function(event){
            event.preventDefault();

            Swal.fire({
                title: 'هل انت متأكد ؟',
                text: "لايمكنك التراجع عن هذا الاجراء.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم احذفه',
                cancelButtonText: 'تراجع'
                }).then((result) => {
                if (result.value) {
                    $(this).parent().submit();
                }
                })



        });
      })

</script>
@endsection

@push('extra-js')
<script src="{{ asset('js/sweetalert.js') }}"></script>
@endpush
