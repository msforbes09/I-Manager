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


Auth::routes(['register' => false]);

Route::get('/', 'PageController@home')->name('home');
Route::get('/summary', 'PageController@summary')->name('summary');

Route::resource('/income', 'IncomeController');
Route::resource('/expense', 'ExpenseController')->except(['create']);

Route::prefix('/expense')->name('expense.')->group(function () {
    Route::get('/date/{date}', 'ExpenseController@daily')->name('daily');
    Route::get('/date/{date}/create', 'ExpenseController@create')->name('create');
});
