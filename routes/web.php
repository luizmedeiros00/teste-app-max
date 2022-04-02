<?php

use App\Http\Controllers\ProductController;
use App\Models\Movement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\MovementController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('products.index');
    });

    Route::get('reports', [MovementController::class, 'report'])->name('reports');

    Route::get('/adicionar-produto', [ProductController::class, 'add']);
    Route::get('/remover-produto', [ProductController::class, 'remove']);

    
    Route::post('/adicionar-produto', [MovementController::class, 'add'])->name('movements.adicionar-produto');
    Route::post('/baixar-produto', [MovementController::class, 'remove'])->name('movements.remover-produto');
    Route::resource('products', ProductController::class);
});

Auth::routes();








