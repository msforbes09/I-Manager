<?php

Route::post('/login', 'AuthController@login');

Route::middleware('auth:api')->group(function() {
    Route::post('/logout', 'AuthController@logout');
    Route::get('/summary', 'Api\SummaryController@index');

    Route::post('/income', 'Api\IncomeController@index');
    Route::post('/income/store', 'Api\IncomeController@store');
    Route::get('/income/{income}', 'Api\IncomeController@show');

    Route::post('/expense', 'Api\ExpenseController@index');
    Route::post('/expense/store', 'Api\ExpenseController@store');
    Route::get('/expense/date/{date}', 'Api\ExpenseController@daily');
    Route::post('/expense/search', 'Api\ExpenseController@search');
    Route::get('/expense/{expense}', 'Api\ExpenseController@show');
});
