<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', 'ProductController@search')->name('product');


Route::get('superadmin/category_docs', 'Superadmin\CategoryDocAPIController@index');
Route::post('superadmin/category_docs', 'Superadmin\CategoryDocAPIController@store');
Route::get('superadmin/category_docs/{category_docs}', 'Superadmin\CategoryDocAPIController@show');
Route::put('superadmin/category_docs/{category_docs}', 'Superadmin\CategoryDocAPIController@update');
Route::patch('superadmin/category_docs/{category_docs}', 'Superadmin\CategoryDocAPIController@update');
Route::delete('superadmin/category_docs{category_docs}', 'Superadmin\CategoryDocAPIController@destroy');

Route::get('superadmin/documents', 'Superadmin\DocumentAPIController@index');
Route::post('superadmin/documents', 'Superadmin\DocumentAPIController@store');
Route::get('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@show');
Route::put('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::patch('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::delete('superadmin/documents{documents}', 'Superadmin\DocumentAPIController@destroy');

Route::get('superadmin/documents', 'Superadmin\DocumentAPIController@index');
Route::post('superadmin/documents', 'Superadmin\DocumentAPIController@store');
Route::get('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@show');
Route::put('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::patch('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::delete('superadmin/documents{documents}', 'Superadmin\DocumentAPIController@destroy');

Route::get('superadmin/documents', 'Superadmin\DocumentAPIController@index');
Route::post('superadmin/documents', 'Superadmin\DocumentAPIController@store');
Route::get('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@show');
Route::put('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::patch('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::delete('superadmin/documents{documents}', 'Superadmin\DocumentAPIController@destroy');

Route::get('superadmin/documents', 'Superadmin\DocumentAPIController@index');
Route::post('superadmin/documents', 'Superadmin\DocumentAPIController@store');
Route::get('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@show');
Route::put('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::patch('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::delete('superadmin/documents{documents}', 'Superadmin\DocumentAPIController@destroy');

Route::get('superadmin/documents', 'Superadmin\DocumentAPIController@index');
Route::post('superadmin/documents', 'Superadmin\DocumentAPIController@store');
Route::get('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@show');
Route::put('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::patch('superadmin/documents/{documents}', 'Superadmin\DocumentAPIController@update');
Route::delete('superadmin/documents{documents}', 'Superadmin\DocumentAPIController@destroy');

Route::get('superadmin/document_categories', 'Superadmin\DocumentCategoryAPIController@index');
Route::post('superadmin/document_categories', 'Superadmin\DocumentCategoryAPIController@store');
Route::get('superadmin/document_categories/{document_categories}', 'Superadmin\DocumentCategoryAPIController@show');
Route::put('superadmin/document_categories/{document_categories}', 'Superadmin\DocumentCategoryAPIController@update');
Route::patch('superadmin/document_categories/{document_categories}', 'Superadmin\DocumentCategoryAPIController@update');
Route::delete('superadmin/document_categories{document_categories}', 'Superadmin\DocumentCategoryAPIController@destroy');

Route::resource('offer_posts', 'OfferPostAPIController');

Route::get('superadmin/files', 'Superadmin\FileAPIController@index');
Route::post('superadmin/files', 'Superadmin\FileAPIController@store');
Route::get('superadmin/files/{files}', 'Superadmin\FileAPIController@show');
Route::put('superadmin/files/{files}', 'Superadmin\FileAPIController@update');
Route::patch('superadmin/files/{files}', 'Superadmin\FileAPIController@update');
Route::delete('superadmin/files{files}', 'Superadmin\FileAPIController@destroy');

Route::get('superadmin/sentences', 'Superadmin\SentenceAPIController@index');
Route::post('superadmin/sentences', 'Superadmin\SentenceAPIController@store');
Route::get('superadmin/sentences/{sentences}', 'Superadmin\SentenceAPIController@show');
Route::put('superadmin/sentences/{sentences}', 'Superadmin\SentenceAPIController@update');
Route::patch('superadmin/sentences/{sentences}', 'Superadmin\SentenceAPIController@update');
Route::delete('superadmin/sentences{sentences}', 'Superadmin\SentenceAPIController@destroy');



Route::get('superadmin/document_files', 'Superadmin\DocumentFileAPIController@index');
Route::post('superadmin/document_files', 'Superadmin\DocumentFileAPIController@store');
Route::get('superadmin/document_files/{document_files}', 'Superadmin\DocumentFileAPIController@show');
Route::put('superadmin/document_files/{document_files}', 'Superadmin\DocumentFileAPIController@update');
Route::patch('superadmin/document_files/{document_files}', 'Superadmin\DocumentFileAPIController@update');
Route::delete('superadmin/document_files{document_files}', 'Superadmin\DocumentFileAPIController@destroy');