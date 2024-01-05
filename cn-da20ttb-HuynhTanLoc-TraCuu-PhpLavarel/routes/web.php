<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
    //return view('index');
//});

Route::get('/',[HomeController::class,'index'])->name('app.home');
Route::get('/home',[HomeController::class,'home'])->name('home');

Route::get('/dang-nhap',[HomeController::class,'loginUser'])->name('app.login');

Route::get('/dia-diem/{slug}.html',[HomeController::class,'searchdd'])->name('searchdd');
Route::get('/am-thuc/{slug}.html',[HomeController::class,'searchamthuc'])->name('searchamthuc');
Route::get('/luu-tru/{slug}.html',[HomeController::class,'searchluutru'])->name('searchluutru');

Route::get('/dia-diem/{slug?}',[HomeController::class,'diadiem'])->name('diadiem');
Route::get('/luu-tru/{slug?}',[HomeController::class,'luutru'])->name('luutru');
Route::get('/am-thuc/{slug?}',[HomeController::class,'amthuc'])->name('amthuc');
Route::get('/danh-muc/{slug?}',[HomeController::class,'danhmuc'])->name('danhmuc');



