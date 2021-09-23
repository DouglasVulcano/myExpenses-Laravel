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

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;

Route::get('/', [ExpenseController::class, 'index']);

Route::get('/dashboard', [ExpenseController::class, 'dashboard'])->middleware('auth');
Route::post('/expenses', [ExpenseController::class, 'store']);
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy'])->middleware('auth');

/** Edição */
Route::get('/expenses/edit/{id}', [ExpenseController::class, 'edit'])->middleware('auth');
Route::put('/expenses/update/{id}', [ExpenseController::class, 'update'])->middleware('auth');

/** Página com todos os cadastros */
Route::get('/expenses/list', [ExpenseController::class, 'list'])->middleware('auth');

/** Página com dados do usuáro */
Route::get('/expenses/profile', [UserController::class, 'profile'])->middleware('auth');
Route::put('/expenses/passwordUpdate', [UserController::class, 'passwordUpdate'])->middleware('auth');
Route::put('/expenses/nameUpdate', [UserController::class, 'nameUpdate'])->middleware('auth');