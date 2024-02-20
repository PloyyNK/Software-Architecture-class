<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::delete('/items/{id}', [ItemController::class, 'destroy']);
Route::get('/items/update/{id}', [ItemController::class, 'show']);
Route::put('/items/{id}', [ItemController::class, 'update']);

Route::get('/sales/{id}', [SaleController::class, 'view'])->name('sale.view');
Route::post('/sales/open', [SaleController::class, 'openSale'])->name('sale.open');

Route::post('/sales/{sale}/add', [SaleController::class, 'addSaleLineItem'])->name('sale.add');
Route::put('/sales/{sale}/close', [SaleController::class, 'closeSale'])->name('sale.close');
Route::delete('/sale/delete/{id}', [SaleController::class, 'removeSaleLineItem']);
