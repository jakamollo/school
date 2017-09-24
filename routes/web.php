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

//Route::get('/', [
//   'as' =>'get_login',
//    'uses' => 'UserController@get_login'
//]);
//Route::post('profile', [
//    'as' => 'login',
//    'uses' => 'UserController@login'
//]);
//// route to the sign_up
//Route::get('sign_up', [
//    'as' => 'get_sign_up',
//    'uses' => 'UserController@get_sign_up'
//]);
////// route to post sign-up
//Route::post('user/profile', [
//    'as' => 'sign_up',
//    'uses' => 'UserController@sign_up'
//]);
//
// Route::patch('user/{id}', [
//     'as' => 'user_update',
//     'uses' => 'UserController@update'
// ]);

//
//// Auth middleware group
////Route::group(['middleware' => ['auth']], function(){
//    // route to the dashboard
//    Route::get('dashboard/{id}', [
//        'as' => 'get_dashboard',
//        'uses' => 'UserController@get_dashboard'
//    ]);
////});

Route::group(['middleware' => 'guest'], function(){
   Route::get('/', function(){
       return view('auth.register');
    });
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

    // route to post sign up
    Route::post('/register', [
        'as' => 'post_signup',
        'uses' => 'Auth\RegisterController@post_signup'
    ]);

// route to get login page
    Route::get('/login', [
        'as' => 'login',
        'uses' => 'Auth\LoginController@showLoginForm'
    ]);

// route to get sign up page
    Route::get('/register', [
        'as' => 'get_signup',
        'uses' => 'Auth\RegisterController@showRegistrationForm'
    ]);

    // route to post login
    Route::post('profile', [
       'as' => 'post_login',
        'uses' => 'Auth\LoginController@login'
    ]);


// route to dashboard
Route::get('dashboard',[
   'as' => 'get_dashboard',
    'uses' => 'UserController@get_dashboard'
]);

// route to update user
Route::patch('user/{id}',[
    'as' => 'user_update',
    'uses' => 'UserController@update'
]);

// route to user profile
Route::get('/user/profile', [
    'as' => 'get_profile',
    'uses' => 'UserController@get_profile'
]);

// route to register school
Route::post('dashboard', [
    'as' => 'register_school',
    'uses' => 'SchoolController@register_school'
]);

// route to school registration page
Route::get('school/register', [
    'as' => 'get_school_register',
    'uses' => 'SchoolController@school_register',
]);

// route to logout
Route::post('logout',[
   'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);
// route to school home page
Route::get('school/home/{id}', [
    'as' => 'school_home',
    'uses' => 'SchoolController@get_home'
]);
// route to update school
Route::patch('school/{id}', [
   'as' => 'school_update',
    'uses' => 'SchoolController@update'
]);
// route to post new student
Route::post('/school/home', [
   'as' => 'new_student',
    'uses' => 'StudentController@post_student'
]);
// route to get student registration form
Route::get('student/register', [
   'as' => 'get_student_reg',
    'uses' => 'StudentController@get_register'
]);
// route to post student register
Route::post('student/register', [
   'as' => 'post_student_reg',
    'uses' => 'StudentController@post_register'
]);
// route to post new staff
Route::post('/shool/home', [
   'as' => 'new_staff',
    'uses' => 'StaffController@post_staff'
]);
// route to staff registration form
Route::get('staff/register', [
   'as' => 'get_staff_reg',
    'uses' => 'StaffController@get_register'
]);
// route to post staff
Route::post('staff/register', [
   'as' => 'post_staff_reg',
    'uses' => 'StaffController@register_staff'
]);
// route to home page
Route::get('home', [
    'as' => 'get_homepage',
    'uses' => 'HomeController@homepage'
]);
// route to post post
Route::post('home', [
    'as' => 'post_post',
    'uses' => 'PostController@post'
]);
//route to delete post
Route::delete('/post/delete/{id}', [
   'as' => 'delete_post',
    'uses' => 'PostController@deletePost'
]);
// route to update post
Route::patch('post/{id}', [
   'as' => 'update_post',
    'uses' => 'PostController@update'
]);
// route to new subject
Route::post('/subject/new', [
    'as' => 'new_subject',
    'uses' => 'SubjectController@create'
]);
# Change password route
Route::patch('user/password/change/{id}', [
    'as' => 'change_password',
    'uses' => 'UserController@change_password'
]);
