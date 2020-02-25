<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/home','AdminController@index');
Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
Route::post('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::post('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/reset','Admin\ResetPasswordController@reset');
Route::get('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');



Route::resource('admin-category','Admin\AdmincategoryController');
Route::resource('admin-question','Admin\AdminquestionController');
Route::resource('admin-option','Admin\AdminoptionController');
Route::resource('admin-cateques','Admin\AdmincatequesController');

// Admin question category ajax
Route::GET('/quesCateajaxcall','Admin\AdmincatequesController@quesCate_ajaxcall');
Route::GET('/ques_ajax','Admin\AdmincatequesController@ques_ajax');
Route::GET('/catetoques_ajax','Admin\AdmincatequesController@catetoques_ajax');
Route::GET('/ques_opt_ajax','Admin\AdmincatequesController@ques_opt_ajax');
Route::GET('/checking_priority_with_count','Admin\AdmincatequesController@checking_priority_with_count');
Route::GET('/category_priority','Admin\AdmincatequesController@category_priority');
Route::GET('/optionchange_method_ajax','Admin\AdmincatequesController@optionchange_method_ajax');

// Admin option ajax
Route::GET('/option_type_ajax','Admin\AdminoptionController@option_type_ajax');