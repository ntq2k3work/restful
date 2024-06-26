<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('/persons',[PersonController::class,'index']) -> name('persons.index');
// Route::get('/persons/{id}',[PersonController::class,'show']) -> name('persons.show');
// Route::get('/persons/search',[PersonController::class,'search']) -> name('persons.search');
// Route::post('/persons/store',[PersonController::class,'store']) -> name('persons.store');
// Route::put('/edit/{id}',[PersonController::class,'update']) -> name('persons.edit');
// Route::delete('/delete/{id}',[PersonController::class,'destroy']) -> name('persons.delete');

// Route::apiResource('persons',PersonController::class);

Route::prefix('persons') -> group(function(){
    Route::get('/',[PersonController::class,'index']) -> name('persons.index');
    Route::get('/{id}',[PersonController::class,'show']) -> name('persons.show');
    Route::get('/search',[PersonController::class,'search']) -> name('persons.search');
    Route::post('/store',[PersonController::class,'store']) -> name('persons.store');
    Route::put('/edit/{id}',[PersonController::class,'update']) -> name('persons.update');
    Route::patch('/edit/{id}',[PersonController::class,'update']) -> name('persons.update');
    Route::delete('/delete/{id}',[PersonController::class,'destroy']) -> name('persons.delete');
});
