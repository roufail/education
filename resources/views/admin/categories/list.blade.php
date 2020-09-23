@extends('admin.layouts.master')


@section('content')
    <div class="col-lg-12">

        @include('admin.layouts.components.alerts')

        <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">التصنيفات</h5>

            <div class="card-tools float-left">
                <a href="{{ route('admin.categories.create') }}"><i class="fa fa-plus"></i></a>
            </div>

        </div>
        <div class="card-body">
        @if ($categories->count() > 0)
        <table class="table table-bordered">
            <tbody>
            <tr>
              <th style="width: 10px">#</th>
              <th>التصنيف</th>
              <th>خيارات</th>
            </tr>
            @foreach ($categories as $category)
                <tr>
                   <td>
                       {{ $loop->iteration }}
                   </td>
                   <td>
                       {{ $category->category }}
                   </td>

            <td>

                        <div class="float-right">
                            <a href="{{ route('admin.categories.edit',$category->id) }}"><i
                                    class="fa fa-edit"></i>&nbsp;تعديل</a>
                        </div>

                        <div class="float-right mr-3">
                            <form style="display:inline-flex" method="post"
                                action="{{ route('admin.categories.destroy',$category->id) }}">
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
            there is no categories
        @endif






        </div><!-- card body -->


        <div class="card-footer clearfix">
            {{ $categories->render('admin.layouts.components.pagination') }}
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
