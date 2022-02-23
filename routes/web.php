<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InitController;
use App\Http\Controllers\LuckyController;
use App\Http\Controllers\SessionController;



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

Route::get('/',[InitController::class, 'init'] )->name('init');
Route::post('/', [InitController::class, 'process'])->name('process');
Route::group(['prefix' => '/lucky/{link}'], function () {
    Route::get('/', [LuckyController::class, "go"])->name('lucky');
    Route::post('/', [LuckyController::class, "checkLucky"])->name('fun');
    Route::post('/history/', [LuckyController::class, "history"])->name('history');
    Route::post('/generate/', [LuckyController::class, "generateNewLink"])->name('generateNewLink');
    Route::post('/deactivate/', [LuckyController::class, "deactivateLink"])->name('deactivate');

});
//Route::resource('link',LinkController::class);
//Route::get('/login',[LoginController::class,'index'])->name('login.index');
//Route::post('/login',[LoginController::class,'submit'])->name('login.submit');

Route::group(['prefix' =>'session'], function(){
    Route::get('/get',[SessionController::class,'getSessionData'])->name('session.get');
    Route::get('/set',[SessionController::class,'storeSessionData'])->name('session.store');
    Route::get('/delete',[SessionController::class,'deleteSessionData'])->name('session.delete');
});



