<?php

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

Route::get('/', function () {
    return view('layouts.main');
});
Route::get('/category/{name}', [
    'uses' => 'CategoryController@categoryAction'
]);
Route::get('/goods/{id}', [
    'uses' => 'GoodsController@goodInfo'
]);
Route::get('/order/{id}', [
    'uses' => 'OrderController@buyAction'
]);
Route::post('/order_final', [
    'uses' => 'OrderController@finishAction'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/// Adminka
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('active', [
        'uses' => 'AdminController@index',
    ]);
    Route::get('active', [
        'uses' => 'AdminController@index',
    ]);
    Route::get('category', [
        'uses' => 'AdminController@category',
    ]);

    Route::group(['prefix' => 'active'], function (){

        Route::post('addCategoryMenuTop', [
            'uses' => 'AdminController@addCategoryMenuTop',
        ]);
        Route::post('deleteCategoryMenuTop', [
            'uses' => 'AdminController@deleteCategoryMenuTop',
        ]);
        Route::post('editCategoryMenuTop', [
            'uses' => 'AdminController@editCategoryMenuTop',
        ]);
        Route::post('editFooterSetting', [
            'uses' => 'AdminController@editFooterSetting',
        ]);
        Route::get('asd', function (){
            return 'fsdfs';
        });
    });
    Route::group(['prefix' => 'category'], function () {
        Route::post('addCategoryGoods', [
            'uses' => 'AdminController@addCategoryGoods',
        ]);
        Route::post('editCategoryGoods', [
            'uses' => 'AdminController@editCategoryGoods',
        ]);
        Route::post('deleteCategoryGoods', [
            'uses' => 'AdminController@deleteCategoryGoods',
        ]);
    });


    });