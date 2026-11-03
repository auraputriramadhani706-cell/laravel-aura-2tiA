<?php


use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [HomeController::class, 'index']);


Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');


Route::get('dashboard', [DashbordController::class, 'index'])->name('dashboard');


Route::resource('pelanggan', PelangganController::class);


Route::get('/', [BiodataController::class, 'index'])->name('cv.index');


Route::get('/', [BiodataController::class, 'index']);
Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');


Route::post('/biodata', [BiodataController::class, 'storeBiodata'])->name('biodata.store');
Route::put('/biodata/{id}', [BiodataController::class, 'updateBiodata'])->name('biodata.update');


Route::post('/pengalaman', [BiodataController::class, 'storePengalaman'])->name('pengalaman.store');
Route::delete('/pengalaman/{id}', [BiodataController::class, 'destroyPengalaman'])->name('pengalaman.destroy');
