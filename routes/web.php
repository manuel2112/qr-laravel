<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');

Route::get('/empresa', [EmpresaController::class, 'index'])->middleware(['auth','verified'])->name('empresa.index');

require __DIR__.'/auth.php';
