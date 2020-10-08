<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">تعليمي </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth('admins')->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->

                    <li
                        class="nav-item has-treeview {{ Route::is('admin.students.index') || Route::is('admin.students.create') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Route::is('admin.students.index') || Route::is('admin.students.create') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                الطلاب
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.students.index') }}"
                                    class="nav-link {{ Route::is('admin.students.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>قائمه الطلاب</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.students.create') }}"
                                    class="nav-link  {{ Route::is('admin.students.create') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>اضافة طالب</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li
                        class="nav-item has-treeview {{ Route::is('admin.categories.index') || Route::is('admin.categories.create') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Route::is('admin.categories.index') || Route::is('admin.categories.create') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                التصنيفات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}"
                                    class="nav-link {{ Route::is('admin.categories.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>قائمه التصنيفات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.create') }}"
                                    class="nav-link  {{ Route::is('admin.categories.create') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>اضافة تصنيف</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li
                        class="nav-item has-treeview {{ Route::is('admin.exams.index') || Route::is('admin.exams.create') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Route::is('admin.exams.index') || Route::is('admin.exams.create') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                الامتحانات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.exams.index') }}"
                                    class="nav-link {{ Route::is('admin.exams.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>قائمه الامتحانات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.exams.create') }}"
                                    class="nav-link  {{ Route::is('admin.exams.create') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>اضافة امتحان</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.results.index') }}"
                                    class="nav-link  {{ Route::is('admin.results.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>النتائج</p>
                                </a>
                            </li>

                        </ul>
                    </li>




                    <li
                        class="nav-item has-treeview {{ Route::is('admin.courses.index') || Route::is('admin.courses.create') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Route::is('admin.courses.index') || Route::is('admin.courses.create') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-university"></i>
                            <p>
                                الكورسات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.courses.index') }}"
                                    class="nav-link {{ Route::is('admin.courses.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>قائمه الكورسات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.courses.create') }}"
                                    class="nav-link  {{ Route::is('admin.courses.create') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>اضافة كورس</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-th"></i>
                            <p>
                                لینک ساده
                                <span class="right badge badge-danger">جدید</span>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
