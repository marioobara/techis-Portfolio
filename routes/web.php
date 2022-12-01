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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::fallback(function () {
    return redirect('/items');//ログイン後にリダイレクトさせるURL
  });
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'store'])->name('posts.index'); //検索を追加


Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    //削除追加
    Route::post('/delete', [App\Http\Controllers\ItemController::class, 'delete']);
});

// 編集
Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
Route::post('/itemEdit', [App\Http\Controllers\ItemController::class, 'itemEdit']);
// 管理者
Route::group(['middleware' => ['auth', 'can:isAdmin'], 'prefix' => 'items'], function () {
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/itemStore', [App\Http\Controllers\ItemController::class, 'itemStore'])->name('itemStore');
});
