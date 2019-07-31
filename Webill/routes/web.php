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

Route::name('home')->get('/', 'Pages\RegularController@index');
Route::name('github')->get('github', 'Pages\RegularController@github');

Route::prefix('services')->group(function () {
	Route::name('services-general')->get('/', 'Pages\ServiceController@index');
	Route::name('services-webill')->get('webill', 'Pages\ServiceController@webill');
	Route::name('services-webiz')->get('webiz', 'Pages\ServiceController@webiz');
});

Route::prefix('legal')->group(function () {
	Route::name('legal-general')->get('/', 'Pages\LegalController@index');
	Route::name('legal-cookies')->get('cookies', 'Pages\LegalController@cookies');
	Route::name('legal-privacy')->get('privacy', 'Pages\LegalController@privacy');
});
/*Route::middleware(['lang'])->group(function () {
	Route::post('/language', 'LanguageController@index')->name('language');
});
*/
Route::name('wedash')->get('/wedash', 'Pages\RegularController@wedash');

Route::post('/language', ['middleware' => 'lang', 'uses' => 'LanguageController@index'])->name('language');


Route::get('/home', 'HomeController@index')->name('home');
