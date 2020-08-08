<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// endpoints for users - login and registration
Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::get('usernames', 'API\UserController@allUsernames');

// endpoints for categories
Route::post('category/add', 'API\CategoryController@add');
Route::get('category/all/{user_id}', 'API\CategoryController@all');

// endpoints for income sources
Route::post('source/add', 'API\SourceController@add');
Route::get('source/all/{user_id}', 'API\SourceController@all');

// endpoints for wallet
Route::post('wallet/add', 'API\WalletController@add');
Route::get('wallet/all/{user_id}', 'API\WalletController@all');

// endpoints for recording income
Route::post('income/add', 'API\IncomeController@add');

// endpoints for recording expense
Route::post('expense/add', 'API\ExpenseController@add');
Route::get('expense/all/{user_id}', 'API\ExpenseController@all');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
