<?php

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@Login')->name('login.post');
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('reset/password/{token}','Auth\ResetPasswordController@showResetForm')->name('reset.password');
Route::post('reset/password','Auth\ResetPasswordController@reset')->name('password.update');



Route::get('/', function(){
    return view('admin.homepage');
})->name('home');

Route::resource('/students', 'StudentsController');



Route::get('/exams/get-main-questions/{id}','ExamsController@get_main_questions');
Route::post('/exams/add-main-question','ExamsController@add_main_question');

Route::get('/exams/get-questions/{id}','ExamsController@get_questions');
Route::post('/exams/add-question','ExamsController@add_question');
Route::post('/exams/delete-question','ExamsController@delete_question');
Route::post('/exams/update-question/{question}','ExamsController@update_question');
Route::post('/exams/update-question-order','ExamsController@update_question_order');



Route::resource('/exams', 'ExamsController');

Route::get('/categories/list', 'CategoriesController@list');
Route::resource('/categories', 'CategoriesController');
