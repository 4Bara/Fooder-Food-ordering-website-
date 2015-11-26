<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
 * Home Controller Routing
 */
Route::get('/','HomeController@index');
Route::get('p/{username}','HomeController@profile');
Route::get('login','HomeController@login');
Route::get('logout','HomeController@logout');
Route::get('registration','HomeController@registration');
/*
 * Registeration controller routing
 */
Route::post('/addAccount','RegisterationController@newAccount');
/*
 * Login controller routing
 */
Route::post('/login','loginController@login');
/*
 * Users Action Controller
 */
Route::post('addLike','userActions@addLike');
Route::post('follow','userActions@follow');

/*
 * Restaurant's page routings
 */
Route::get('p/{username}/addNewItemPage','restaurantController@addNewItemPage');
Route::post('p/{username}/backend/addNewItem','restaurantController@addNewItem');