@extends('admin.layouts.master')


@section('content')
<div class="col-lg-12">

    @include('admin.layouts.components.alerts')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">الامتحانات</h5>


        </div>
        <div class="card-body">
            @if ($results->count() > 0)
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>الامتحان</th>
                        <th>الطالب</th>
                        <th>الدرجه النهائيه</th>
                        <th>درجة الطالب</th>
                        <th>النسبة المئوية</th>
                        <th>الاجابات</th>
                    </tr>
                    @foreach ($results as $result)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $result->exam->title }}
                        </td>

                        <td>
                            {{ $result->student->name }}
                        </td>

                        <td>
                            {{ $result->fullmark }}
                        </td>

                        <td>
                            {{ $result->degree }}
                        </td>
                        <td>
                            %{{ $result->percentage }}
                        </td>
                        <td>
                            <a href="{{ route('admin.results.show',$result->id )}}">مشاهدة</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            @else
            there is no results
            @endif






        </div><!-- card body -->


        <div class="card-footer clearfix">
            {{ $results->render('admin.layouts.components.pagination') }}
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
