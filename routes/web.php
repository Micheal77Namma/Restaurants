<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('home');
});


Route::get('logout', 'Auth\LoginController@logout');

Route::middleware(['admin'])->group(function(){
    Route::resource('user', "userController");
    Route::resource('role', "roleController");
    Route::get('user-pagination','userController@page');
    Route::get('role-pagination','roleController@page');
    Route::get('user/{id}/deleted',"userController@deleted");
    Route::get('role/{id}/deleted',"roleController@deleted");
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['rest'])->group(function(){
    Route::resource('restaurant', "restaurantController");
    Route::get('restaurant/{id}/deleted',"restaurantController@deleted");
    Route::get('restaurant-pagination','restaurantController@page');
});


Route::middleware(['meal'])->group(function(){
    Route::resource('category', "categoryController");
    Route::resource('mealType', "mealTypeController");
    Route::resource('meal', "mealController");
    Route::get('category-pagination','categoryController@page');
    Route::get('meal-pagination','mealController@page');
    Route::get('mealType-pagination','mealTypeController@page');
    Route::get('category/{id}/deleted',"categoryController@deleted");
    Route::get('meal/{id}/deleted',"mealController@deleted");
    Route::get('mealType/{id}/deleted',"mealTypeController@deleted");

});
