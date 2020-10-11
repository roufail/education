<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/students/main.css') }}">

    @stack('extra-css')
    <title>@yield('title')</title>
</head>

<body>
    <div class="container">


        <div class="main-nav row">
            <ul class="nav justify-content-start col-6 col-md-9 col-lg-10">
                <li class="nav-item @if(Route::is('student.home')) active @endif">
                    <a class="nav-link" href="{{  route('student.home')  }}">الكورسات</a>
                </li>
                @if(!auth('students')->check())
                <li class="nav-item @if(Route::is('student.login')) active @endif">
                    <a class="nav-link" href="{{  route('student.login')  }}">دخول</a>
                </li>
                <li class="nav-item @if(Route::is('student.register')) active @endif">
                    <a class="nav-link" href="{{  route('student.register')  }}">تسجيل</a>
                </li> @else
                <li class="nav-item">
                    <a class="nav-link" href="#">كورساتي</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('student.logout') }}">تسجيل الخروج</a>
                </li>
                @endif
            </ul>

            <div class="search col-6 col-md-3 col-lg-2">
                <form action="{{ route('student.home') }}">
                    <div class="form-group">
                        <input name="s" value="{{ request()->s }}" type="text" class="form-control search-input"
                            placeholder="البحث ..." />
                        <i class="icon fa fa-search"></i>
                    </div>
                </form>
            </div>
        </div>
        <div class="row text-right pt-3  clearfix">
            @yield('content')
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>
@stack('extra-js')

</html>
