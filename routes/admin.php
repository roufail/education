<?php

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@Login')->name('login.post');
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('reset/password/{token}','Auth\ResetPasswordController@showResetForm')->name('reset.password');
Route::post('reset/password','Auth\ResetPasswordController@reset')->name('password.update');





    Route::group(['middleware' => 'auth:admins'],function(){

        Route::get('/', function(){
            return view('admin.homepage');
        })->name('home');


            Route::resource('/students', 'StudentsController');
            Route::get('/exams/get-main-questions/{id}','ExamsController@get_main_questions');
            Route::post('/exams/add-main-question','ExamsController@add_main_question');
            Route::get('/exams/get-questions/{id}','ExamsController@get_questions');
            Route::post('/exams/add-question','ExamsController@add_question');
            Route::post('/exams/delete-question','ExamsController@delete_question');
            Route::post('/exams/delete-main-question','ExamsController@delete_main_question');
            Route::post('/exams/update-question/{question}','ExamsController@update_question');
            Route::post('/exams/update-question-order','ExamsController@update_question_order');
            Route::post('/exams/update-main-question-order','ExamsController@update_main_question_order');
            Route::post('/exams/update-main-question','ExamsController@update_main_question');
            Route::resource('/exams', 'ExamsController');
            Route::get('/categories/list', 'CategoriesController@list');
            Route::resource('/categories', 'CategoriesController');

            Route::get('course/{course}/lectures','CoursesController@get_course_lecture');

            Route::post('course/lectures','CoursesController@add_lecture');
            Route::put('course/lecture/{lecture}/edit','CoursesController@edit_lecture');
            Route::delete('course/lecture/{lecture}/delete','CoursesController@delete_lecture');

            Route::post('course/lecture/{lecture}/media','CoursesController@add_lecture_media');
            Route::put('course/lecture/{lecture}/media/{attachment}/edit','CoursesController@edit_lecture_media');
            Route::delete('course/lecture/{lecture}/media/{attachment}/delete','CoursesController@delete_lecture_media');
            Route::post('course/update-lectures-order','CoursesController@update_lectures_order');
            Route::post('course/update-lecture-attachment-order','CoursesController@update_lecture_attachment_order');




            Route::resource('/courses', 'CoursesController');
            Route::resource('/results', 'ResultsController');


    });
