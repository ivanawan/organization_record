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


Auth::routes();

// route view yang tidak memerlukan controller

Route::get('/', function () {
    return view('welcome');
});

Route::get('/group/addpeserta',function(){
    return view('addpeserta');
});
Route::get('/new_group',function (){
    return view('newuser.new_group');
});

Route::get('/code_group', function(){
    return view('newuser.code_group');
});
Route::get('/waiting', function(){
    return view('newuser.waiting');
});
// route  creete new group and change session 
Route::post('/home-{$page}',[App\Http\Controllers\newUserController::class, 'selectHome']);
Route::post('/new_group',[App\Http\Controllers\newUserController::class, 'newGroup'])->name('newGroup');
Route::post('/code_group',[App\Http\Controllers\newUserController::class,'codeGroup']);
// rote utama 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['user_new','setsession']);
Route::get('/event',[App\Http\Controllers\EventController::class, 'index'])->middleware('setsession');
Route::get('/keuangan',[App\Http\Controllers\KeuanganController::class, 'index'])->middleware('setsession');
Route::get('/group',[App\Http\Controllers\GroupController::class, 'index'])->middleware('setsession');
Route::get('/page',[App\Http\Controllers\PublicPageController::class, 'index'])->middleware('setsession');
// route support add / edit / delete for main route
// event
Route::post('/event/add',[App\Http\Controllers\EventController::class, 'addEvent']);
Route::get('/absen/{id}',[App\Http\Controllers\EventController::class, 'absenEvent']);
Route::post('/event/kelompok/{id}',[App\Http\Controllers\EventController::class, 'pilihKelompok']);
Route::Post('event/absen/{id}',[App\Http\Controllers\EventController::class, 'absenEventData']);
Route::Post('/event/edit/{id}',[App\Http\Controllers\EventController::class, 'editEvent']);
Route::get('/event/delete/{id}',[App\Http\Controllers\EventController::class, 'deleteEvent']);
// group
Route::get('/group/delte/{id}',[App\Http\Controllers\GroupController::class, 'deletefromwaitinglist']);
Route::get('/group/addtogroup/{id}',[App\Http\Controllers\GroupController::class, 'addtogroup']);
Route::post('/group/changerole/{id}',[App\Http\Controllers\GroupController::class, 'changerole']);
Route::post('/group/add/anggota',[App\Http\Controllers\GroupController::class, 'tambahAnggota']);
Route::post('/group/addpeserta',[App\Http\Controllers\GroupController::class, 'tambahpeserta']);
Route::get('/peserta/{id}',[App\Http\Controllers\GroupController::class, 'getPeserta']);
Route::post('/group/edit/peserta/{id}',[App\Http\Controllers\GroupController::class, 'editData']);
// keuangan
Route::post('/keuangan/add',[App\Http\Controllers\KeuanganController::class, 'add']);
//public page 
