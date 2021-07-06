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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/layout' , function (){
    return view('layouts.layout');
});
// Route::get('/new_user',function (){
    // return view('newuser.new_user');
// })->name('new_user');
Route::get('/new_group', function(){
return view('newuser.new_group');
});
// Route::post('/new_user',[App\Http\Controllers\newUserController::class, 'new_user']);
Route::post('/new_group',[App\Http\Controllers\newUserController::class, 'newGroup']);
