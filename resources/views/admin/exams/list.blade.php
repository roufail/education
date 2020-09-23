@extends('admin.layouts.master')


@section('content')
    <div class="col-lg-12">

        @include('admin.layouts.components.alerts')

        <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">الامتحانات</h5>

            <div class="card-tools float-left">
                <a href="{{ route('admin.exams.create') }}"><i class="fa fa-plus"></i></a>
            </div>

        </div>
        <div class="card-body">
        @if ($exams->count() > 0)
        <table class="table table-bordered">
            <tbody>
            <tr>
              <th style="width: 10px">#</th>
              <th>الامتحان</th>
              <th>الدكتور</th>
              <th>بدايه الامتحان</th>
              <th>نهايه الامتحان</th>
              <th>خيارات</th>
            </tr>
            @foreach ($exams as $exam)
                <tr>
                   <td>
                       {{ $loop->iteration }}
                   </td>
                   <td>
                       {{ $exam->title }}
                   </td>

                   <td>
                    {{ $exam->doctor }}
                   </td>

                   <td>
                    {{ date('Y-m-d',strtotime($exam->started_at)) }}
                </td>

                <td>
                    {{ date('Y-m-d',strtotime($exam->ended_at)) }}
                </td>
            <td>

                        <div class="float-right">
                            <a href="{{ route('admin.exams.edit',$exam->id) }}"><i
                                    class="fa fa-edit"></i>&nbsp;تعديل</a>
                        </div>

                        <div class="float-right mr-3">
                            <form style="display:inline-flex" method="post"
                                action="{{ route('admin.exams.destroy',$exam->id) }}">
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
            there is no exams
        @endif






        </div><!-- card body -->


        <div class="card-footer clearfix">
            {{ $exams->render('admin.layouts.components.pagination') }}
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
