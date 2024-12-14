<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompanyController;




Route::get('/', function () {
    return view('welcome');
});



Route::prefix('products')
->middleware('auth')
->controller(ProductController::class)
->name('products.')
->group(function(){
    Route::get('/','index')->name('index');//商品一覧
    Route::get('/create','create')->name('create');//商品作成
    Route::post('/', 'store')->name('store'); // 商品登録処理
    Route::get('/{id}', 'show')->name('show'); // 商品詳細
    Route::get('/{id}/edit', 'edit')->name('edit'); // 商品編集ページ
    Route::put('/{id}', 'update')->name('update'); // 商品更新処理
    Route::delete('/{id}', 'destroy')->name('destroy'); // 商品削除処理
});

Auth::routes();

Route::resource('companies', CompanyController::class)->except(['create', 'edit']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

