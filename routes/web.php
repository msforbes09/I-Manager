<?php
// authorization
Auth::routes(['register' => false]);

// pages
// Route::get('/', 'PageController@home')->name('home');
// Route::get('/summary', 'PageController@summary')->name('summary');
// Route::get('/expense', 'PageController@expense')->name('expense');
// Route::get('/income', 'PageController@income')->name('income');

// api
Route::prefix(config('app.api_prefix'))->group(function () {
    Route::get('/summary', 'Api\SummaryController@index');

    Route::post('/expense', 'Api\ExpenseController@index');
    Route::post('/expense/store', 'Api\ExpenseController@store');
    Route::get('/expense/date/{date}', 'Api\ExpenseController@daily');
    Route::post('/expense/search', 'Api\ExpenseController@search');
    Route::get('/expense/{expense}', 'Api\ExpenseController@show');

    Route::post('/income', 'Api\IncomeController@index');
    Route::post('/income/store', 'Api\IncomeController@store');
    Route::get('/income/{income}', 'Api\IncomeController@show');
});

Route::get('/{any}', function() {
    return view('home');
})->where('any', '.*')->middleware('auth');



