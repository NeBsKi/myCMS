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
    return view('welcome');
});

Auth::routes();

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

Route::resource('/admin/dashboard', 'DashboardController');

Route::get('/admin/page/filter', 'admin\PageController@filter');
Route::post('/admin/page/destroy', 'admin\PageController@destroy');
Route::get('/admin/page/destroy/{page_id}', 'admin\PageController@destroy');
Route::get('/admin/page/{page_id}/edit', 'admin\PageController@edit');
Route::post('/admin/page/gallery/{page_id}', 'admin\PageController@addGallery');


Route::resource('/admin/page', 'admin\PageController', ['names' => [
    'create' => 'admin.page.create',
    'update' => 'admin.page.update',
    'destroy' => 'admin.page.destroy',
]]);
