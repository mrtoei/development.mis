<?php
//use Illuminate\Routing\Route;
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

Auth::routes(['register' => false,'login'=>false]);
Route::get('/', 'AuthController@index');
Route::post('/checklogin','AuthController@checklogin');
Route::get('/checklogin',function(){
    return redirect('/');
});
Route::get('/logout','AuthController@logout');


Route::group(['middleware' => 'checkuser'], function () {
    Route::get('/admin', 'AdminController@index');
    Route::get('/gallery', 'AdminController@gallery');
    Route::get('/user', 'AdminController@user');
    Route::get('/add-user', 'AdminController@user_create');
    Route::get('/edit-user/{id}', 'AdminController@user_edit');
    Route::get('/profile', 'AdminController@profile');
    Route::get('/reset-password', 'AdminController@reset_password');

    
    
});


