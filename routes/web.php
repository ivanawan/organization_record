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

// Route::get('/layout' , function (){
    // return view('layouts.layout');
// });
Route::get('/new_group',function (){
    return view('newuser.new_group');
});

Route::get('/code_group', function(){
    return view('newuser.code_group');
});
Route::post('/home-{$page}',[App\Http\Controllers\newUserController::class, 'selectHome']);
Route::post('/new_group',[App\Http\Controllers\newUserController::class, 'newGroup'])->name('newGroup');
Route::post('/code_group',[App\Http\Controllers\newUserController::class,'codeGroup']);
Route::get('/homeset',[App\Http\Controllers\HomeController::class, 'homeSet'])->name('homeSet');
//route menu

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/event',[App\Http\Controllers\EventController::class, 'index']);
Route::get('/keuangan',[App\Http\Controllers\KeuanganController::class, 'index']);
Route::get('/group',[App\Http\Controllers\GroupController::class, 'index']);
Route::get('/Agenda',[App\Http\Controllers\AgendaController::class, 'index']);
Route::get('/task',[App\Http\Controllers\TaskController::class, 'index']);

