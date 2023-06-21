<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;

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
Route::get('/login', [BackendController::class, 'login'])->name('login')->middleware('guest');
Route::post('/actionlogin', [BackendController::class, 'actionlogin'])->name('actionlogin');
Route::get('/logout', [BackendController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [BackendController::class, 'index'])->name('backend.index');

    Route::get('/browsekota', [BackendController::class, 'browsekota'])->name('backend.kota.browse');
    Route::post('/addkota', [BackendController::class, 'addkota'])->name('backend.kota.add');

    Route::get('/browsemobil', [BackendController::class, 'browsemobil'])->name('backend.mobil.browse');
    Route::post('/addmobil', [BackendController::class, 'addmobil'])->name('backend.mobil.add');

    Route::get('/browsebiaya', [BackendController::class, 'browsebiaya'])->name('backend.biaya.browse');
    Route::post('/addbiaya', [BackendController::class, 'addbiaya'])->name('backend.biaya.add');
    Route::get('/browsebiaya/{id:id}', [BackendController::class, 'editbiaya'])->name('backend.biaya.showedit');
    Route::post('/goeditbiaya', [BackendController::class, 'actioneditbiaya'])->name('backend.biaya.actionedit');
    Route::post('/godeletebiaya', [BackendController::class, 'actiondeletebiaya'])->name('backend.biaya.actiondelete');
    Route::get('/gocaribiaya', [BackendController::class, 'actioncaribiaya'])->name('backend.biaya.actioncari');

});

