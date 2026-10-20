<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\HomeController;
use App\http\Controllers\QuestionController;
use App\Http\Controllers\DashbordControlle;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);
Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');
route::get('dashboard', [DashbordControlle::class, 'index'])->name('dashboard');

Route::resource('pelanggan', PelangganController::class);
