<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin','Admin@index');
Route::get('/admin/subject_creation','Admin@subject_creation');

Route::post('/admin/add_new_subject','Admin@add_new_subject');

Route::get('/admin/delete_subject/{subject_name}','Admin@delete_subject');
Route::get('/admin/edit_subject/{subject_name}','Admin@edit_subject');
Route::post('admin/edit_new_subject','Admin@edit_new_subject');
Route::get('/admin/subject_status/{subject_name}','Admin@subject_status');
Route::get('/admin/manage_exam','Admin@manage_exam');
Route::post('/admin/add_new_exam','admin@add_new_exam');
Route::get('/admin/exam_status/{id}','Admin@exam_status');
Route::get('/admin/delete_exam/{id}','Admin@delete_exam');
Route::get('/admin/update_exam/{id}','Admin@update_exam');
Route::post('/admin/confirm_update_exam','Admin@confirm_update_exam');

Route::get('/admin/exam_result/{id}','Admin@exam_result');

Route:: get('/admin/students/{subject_name}','Admin@students');

//question
Route::get('/admin/add_question/{id}','QuestionPaper@add_question');
Route::post('/admin/add_new_question','QuestionPaper@add_new_question');
Route::get('/admin/question_status/{id}/{type}','QuestionPaper@question_status');
Route::get('/admin/delete_question/{id}/{type}','QuestionPaper@delete_question');
Route::get('/admin/update_question/{id}/{type}','QuestionPaper@update_question');
Route::post('/admin/confirm_update_question','QuestionPaper@confirm_update_question');
Route::post('/admin/confirm_update_oneword','QuestionPaper@confirm_update_oneword');
Route::post('/admin/confirm_update_match','QuestionPaper@confirm_update_match');


//student
Route:: get('/student/signup','Student@student_signup');
Route:: post('/student/add_new_student','Student@add_new_student');
Route:: get('/student/student_login','Student@student_login');
Route:: post('/student/stud_login','Student@stud_login');
Route:: get('/student/student_dashboard','StudentActivity@student_dashboard');
Route:: get('/student/student_logout','StudentActivity@student_logout');
Route:: get('/student/enroll/{subject_name}','StudentActivity@enroll');
Route::post('/student/verify_enroll','StudentActivity@verify_enroll');
Route:: get('/student/student_subjects','StudentActivity@student_subjects');
Route:: get('/student/exam','StudentActivity@exam');
Route:: get('/student/join_exam/{id}','StudentActivity@join_exam');
Route:: post('/student/submit_exam','StudentActivity@submit_exam');
Route:: get('/student/show_result','StudentActivity@show_result');


Route::get('/student/forget-password', 'ForgotPasswordController@getEmail');
Route::post('/student/forget-password', 'ForgotPasswordController@postEmail');

Route::get('/student/reset-password/{token}', 'ResetPasswordController@getPassword');
Route::post('/student/reset-password2', 'ResetPasswordController@updatePassword');