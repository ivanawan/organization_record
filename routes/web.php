<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Routing\UrlGenerator;
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
if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}


Auth::routes(['verify' => true]);

// route view yang tidak memerlukan controller

Route::get('/', function () {
    return view('welcome');
});

Route::get('/group/addpeserta',function(){
    return view('addpeserta');
})->middleware(['login']);
Route::get('/new_group',function (){
    return view('newuser.new_group');
})->middleware(['login']);

Route::get('/code_group', function(){
    return view('newuser.code_group');
})->middleware(['login']);
Route::get('/waiting', function(){
    return view('newuser.waiting');
})->middleware(['login']);
// route  creete new group and change session 
Route::post('/home-{$page}',[App\Http\Controllers\newUserController::class, 'selectHome'])->middleware(['login']);
Route::post('/new_group',[App\Http\Controllers\newUserController::class, 'newGroup'])->name('newGroup')->middleware(['login']);
Route::post('/code_group',[App\Http\Controllers\newUserController::class,'codeGroup'])->middleware(['login']);
// rote utama 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['session']);
Route::get('/event',[App\Http\Controllers\EventController::class, 'index'])->middleware('session');
Route::get('/keuangan',[App\Http\Controllers\KeuanganController::class, 'index'])->middleware('session');
Route::get('/group',[App\Http\Controllers\GroupController::class, 'index'])->middleware('session');
// Route::get('/page',[App\Http\Controllers\PublicPageController::class, 'index'])->middleware('setsession');
// route support add / edit / delete for main route
// event
Route::post('/event/add',[App\Http\Controllers\EventController::class, 'addEvent'])->middleware(['session']);
Route::get('/absen/{id}',[App\Http\Controllers\EventController::class, 'absenEvent'])->middleware(['session']);
Route::post('/event/kelompok/{id}',[App\Http\Controllers\EventController::class, 'pilihKelompok'])->middleware(['session']);
Route::Post('event/absen/{id}',[App\Http\Controllers\EventController::class, 'absenEventData'])->middleware(['session']);
Route::Post('/event/edit/{id}',[App\Http\Controllers\EventController::class, 'editEvent'])->middleware(['session']);
Route::get('/event/delete/{id}',[App\Http\Controllers\EventController::class, 'deleteEvent'])->middleware(['session']);
// group
Route::get('/group/role/{id}',[App\Http\Controllers\GroupController::class, 'roleGroup'])->middleware(['session']);
Route::get('/group/delte/{id}',[App\Http\Controllers\GroupController::class, 'deletefromwaitinglist'])->middleware(['session']);
Route::put('/group/edit/eden',[App\Http\Controllers\GroupController::class, 'editNameAndDesc'])->middleware(['session']);
Route::get('/group/addtogroup/{id}',[App\Http\Controllers\GroupController::class, 'addtogroup'])->middleware(['session']);
Route::post('/group/changerole/{id}',[App\Http\Controllers\GroupController::class, 'changerole'])->middleware(['session']);
Route::post('/group/add/anggota',[App\Http\Controllers\GroupController::class, 'tambahAnggota'])->middleware(['session']);
Route::post('/group/addpeserta',[App\Http\Controllers\GroupController::class, 'tambahpeserta'])->middleware(['session']);
Route::get('/peserta/{id}',[App\Http\Controllers\GroupController::class, 'getPeserta'])->middleware(['session']);
Route::post('/group/edit/peserta/{id}',[App\Http\Controllers\GroupController::class, 'editData'])->middleware(['session']);
// keuangan
Route::post('/keuangan/add',[App\Http\Controllers\KeuanganController::class, 'add'])->middleware(['session']);
//public page 
Route::get('/group/{code}',[App\Http\Controllers\HomeController::class, 'publicPage']);
//user
Route::get('/user',[App\Http\Controllers\UserController::class, 'index']);
Route::put('/user/edit',[App\Http\Controllers\UserController::class, 'userEdit']);
Route::Post('/user/edit/pass',[App\Http\Controllers\UserController::class, 'changePassword']);
Route::get('/group/out/{id}/{role}',[App\Http\Controllers\UserController::class, 'groupOut']);
Route::get('/group/delete/{id}/{role}',[App\Http\Controllers\UserController::class, 'groupDelete']);
//Agenda 
Route::get('/agenda',[App\Http\Controllers\AgendaController::class, 'index']);
Route::post('/agenda/add',[App\Http\Controllers\AgendaController::class, 'store']);
Route::get('/agenda/delete/{id}',[App\Http\Controllers\AgendaController::class, 'delete']);
Route::get('/agenda/edit/{id}',[App\Http\Controllers\AgendaController::class, 'viewEdit']);
Route::Post('/agenda/edit/{id}',[App\Http\Controllers\AgendaController::class, 'edit']);
Route::get('/agenda/view/{id}',[App\Http\Controllers\AgendaController::class, 'viewAgenda']);
Route::Post('/agenda/view/{id}',[App\Http\Controllers\AgendaController::class, 'checkList']);
Route::get('/agenda/add',function(){
    return view('agendaCrud');
});
