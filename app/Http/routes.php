<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return redirect('/companies');
});

$app->get(
    '/companies',
    ['as' => 'companies', 'uses' => 'CompanyController@getList', 'middleware' => 'auth']
);

$app->get(
    '/stocks/{tickerCode}',
    ['as' => 'stock-info', 'uses' => 'StockController@getInfo', 'middleware' => 'auth']
);
