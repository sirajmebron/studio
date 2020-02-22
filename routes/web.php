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
    return view('auth/login');
});


Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');
//Route::get('/account', 'Auth\LoginController@logout');

Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/dashboard', 'Admin\AdminController@index');
Route::get('/client/dashboard', 'Client\ClientController@index');
Route::get('/customers', 'Admin\CustomerController@index')->name('customers');
Route::get('/customers/create', 'Admin\CustomerController@create')->name('customers/create');
Route::post('/customers/store', 'Admin\CustomerController@store')->name('customers/store');
Route::get('/customers/edit/{id}', 'Admin\CustomerController@edit')->name('customers/edit');
Route::post('/customers/update/{id}', 'Admin\CustomerController@update')->name('customers/update');
Route::post('/customers/destroy/{id}', 'Admin\CustomerController@destroy')->name('customers/destroy');

Route::resource('admin/gallery','Admin\GalleryController');


Route::post('/gallery/store', 'Admin\GalleryController@store')->name('gallery/store');
Route::post('/gallery/ajax_gallery_view_more_image', 'Admin\GalleryController@ajax_gallery_view_more_image')->name('gallery/store');
Route::post('/gallery/ajax_gallery_selected_view_more_image', 'Admin\GalleryController@ajax_gallery_selected_view_more_image')->name('gallery/store');
Route::post('/gallery/update/{id}', 'Admin\GalleryController@update')->name('gallery/update');
Route::post('/gallery/destroy_gallery_upload_image', 'Admin\GalleryController@destroy_gallery_upload_image')->name('gallery/destroy');

/* Route::get('/client/gallery', 'Client\ClientController@gallery'); */
Route::get('/client/gallery/{id}', 'Client\ClientController@gallery');
Route::get('/client/albums', 'Client\ClientController@albums');
Route::post('/client/store_selected_image', 'Client\ClientController@store_selected_image');