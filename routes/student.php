<?php
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->name('register.post');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@Login')->name('login.post');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('reset/password/{token}','Auth\ResetPasswordController@showResetForm')->name('reset.password');
    Route::post('reset/password','Auth\ResetPasswordController@reset')->name('password.update');

    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

    Route::get('/', 'HomeController@home')->name('home');

    // courses
    Route::get('course/{course}', 'HomeController@get_course')->name('course');

    Route::group(['middleware' => 'auth:students'],function(){
        Route::get('profile', 'ExamsController@profile')->name("profile");
        Route::get('get-exam/{id}', 'ExamsController@get_exam');
        Route::post('get-exam-result/{id}', 'ExamsController@get_exam_result');

        Route::post('save-answers', 'ExamsController@save_answers');
        Route::post('get-answers', 'ExamsController@get_answers');
        Route::get('exam/{id}', 'ExamsController@exam')->name('exam');
        Route::post('end-exam', 'ExamsController@end_exam');


        Route::get('course/{course}/enroll', 'HomeController@course_enroll')->name('course.enroll');

        Route::get('my-courses', 'HomeController@my_courses')->name('mycourses');

        Route::get('course/{course}/lecture/{lecture}', 'HomeController@get_lecture')->name('course.lecture');
    });
