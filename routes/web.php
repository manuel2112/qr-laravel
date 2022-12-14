<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MiPlanController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\GeneradorController;

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
Route::post('/empresa/upload', [EmpresaController::class, 'uploadCropImage'])->name('empresa.uploadimage');

Route::get('/menu', MenuController::class )->middleware(['auth','verified'])->name('menu.index');
Route::post('/menu/upload-img-grupo', [MenuController::class, 'uploadgrupoimg'])->name('menu.uploadgrupoimg');
Route::post('/menu/upload-img-producto', [MenuController::class, 'uploadproductoimg'])->name('menu.uploadproductoimg');
Route::post('/menu/upload-img-galeria', [MenuController::class, 'uploadgaleriaimg'])->name('menu.uploadgaleriaimg');

Route::get('/tipopago', TipoPagoController::class )->middleware(['auth','verified'])->name('tipopago.index');

Route::get('/centro-de-pagos', [PayController::class, 'index'])->middleware(['auth','verified'])->name('pay.index');
Route::get('/centro-de-pagos/pay', [PayController::class, 'pay'])->name('pay.pay');
Route::get('/centro-de-pagos/result', [PayController::class, 'result'])->name('pay.result');
Route::get('/centro-de-pagos/mis-compras', [PayController::class, 'miscompras'])->name('pay.miscompras');

Route::get('/contacto', [ContactoController::class, 'index'])->middleware(['auth','verified'])->name('contacto.index');

Route::get('/mi-plan', [MiPlanController::class, 'index'])->middleware(['auth','verified'])->name('miplan.index');

Route::get('/print/pago/{id}', [GeneradorController::class, 'pago'])->name('pdf.pago');

require __DIR__.'/auth.php';
