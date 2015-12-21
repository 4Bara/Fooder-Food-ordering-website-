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
Route::post('search','HomeController@search');
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
//This will redirect the user to add new item page
Route::get('p/{username}/addNewItemPage','restaurantController@addNewItemPage');
//this will add the item to the DB
Route::post('p/{username}/backend/addNewItem','restaurantController@addNewItem');

//This should show offers list
Route::get('p/{username}/offers/{data?}','restaurantController@showOffers');
//Create new offer by the user
Route::get('p/{username}/newOffer','restaurantController@addNewOffer');
//Add Offer to DB
Route::post('p/{username}/backend/addNewOffer','restaurantController@newOffer');

//this should create new menu by the user
Route::get('p/{username}/newMenu','restaurantController@addNewMenu');
//Show all menus for that restaurant
Route::get('p/{username}/menus/{data?}','restaurantController@showMenus');
//Add Menu to DB
Route::post('p/{username}/backend/addNewMenu','restaurantController@newMenu');

/*
 * Write a review
 */
Route::get('p/{username}/writeReview/{data?}','restaurantController@writeReview');
Route::post('p/{username}/writeReview/backend/submitReview','restaurantController@submitReview');
Route::get('/p/{username}/reviews/{data?}','restaurantController@showReviews');
/*
 * Restauarnats Menus / Offers pages routings
 */

Route::get('menu/{data?}','restaurantController@showMenu');
Route::get('offer/{data?}','restaurantController@showOffer');