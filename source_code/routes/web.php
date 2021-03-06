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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', ['as' => 'homepage', 'uses' => 'FrontEnd\HomePageController@index']);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post', 'PostController@index')->name('post');
Route::get('/post/{post}', ['as' => 'post.show', 'uses' => 'PostController@show']);
Route::get('/post/{post}/edit', ['as' => 'post.edit', 'uses' => 'PostController@edit']);
Route::patch('/post/{post}', ['as' => 'post.update', 'uses' => 'PostController@update']);

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\RegisterController@confirm'
]);
Route::get('/get_comment', 'Homecontroller@getComment');
Route::get('/get_comment_multiple_link', 'Homecontroller@getCommentMultipleLink');
Route::get('/get_all_link', 'Homecontroller@getAllLink');
Route::get('/product', 'Homecontroller@products');
Route::get('/get_defind_word', 'Homecontroller@getDefindWord');
Route::get('/test', 'CommentController@index');
Route::get('/chu-tro', 'HostController@index');
Route::get('/get_building', 'HostController@getBuilding');
Route::get('/get_concept_word', 'Homecontroller@getConceptWord');

Route::group(['middleware' => ['auth.superadmin']], function () {
    Route::get('superadmin/dashboard', ['as' => 'superadmin.dashboard.index', 'uses' => 'SuperAdmin\DashboardController@index']);
    //User
    Route::get('superadmin/users', ['as' => 'superadmin.users.index', 'uses' => 'SuperAdmin\UserController@index']);
    Route::post('superadmin/users', ['as' => 'superadmin.users.store', 'uses' => 'SuperAdmin\UserController@store']);
    Route::get('superadmin/users/create', ['as' => 'superadmin.users.create', 'uses' => 'SuperAdmin\UserController@create']);
    Route::put('superadmin/users/{users}', ['as' => 'superadmin.users.update', 'uses' => 'SuperAdmin\UserController@update']);
    Route::patch('superadmin/users/{users}', ['as' => 'superadmin.users.update', 'uses' => 'SuperAdmin\UserController@update']);
    Route::delete('superadmin/users/{users}', ['as' => 'superadmin.users.destroy', 'uses' => 'SuperAdmin\UserController@destroy']);
    Route::get('superadmin/users/{users}', ['as' => 'superadmin.users.show', 'uses' => 'SuperAdmin\UserController@show']);
    Route::get('superadmin/users/{users}/edit', ['as' => 'superadmin.users.edit', 'uses' => 'SuperAdmin\UserController@edit']);
    //Category Doc
    Route::get('superadmin/categoryDocs', ['as' => 'superadmin.categoryDocs.index', 'uses' => 'SuperAdmin\CategoryDocController@index']);
    Route::post('superadmin/categoryDocs', ['as' => 'superadmin.categoryDocs.store', 'uses' => 'SuperAdmin\CategoryDocController@store']);
    Route::get('superadmin/categoryDocs/create', ['as' => 'superadmin.categoryDocs.create', 'uses' => 'SuperAdmin\CategoryDocController@create']);
    Route::put('superadmin/categoryDocs/{categoryDocs}', ['as' => 'superadmin.categoryDocs.update', 'uses' => 'SuperAdmin\CategoryDocController@update']);
    Route::patch('superadmin/categoryDocs/{categoryDocs}', ['as' => 'superadmin.categoryDocs.update', 'uses' => 'SuperAdmin\CategoryDocController@update']);
    Route::delete('superadmin/categoryDocs/{categoryDocs}', ['as' => 'superadmin.categoryDocs.destroy', 'uses' => 'SuperAdmin\CategoryDocController@destroy']);
    Route::get('superadmin/categoryDocs/{categoryDocs}', ['as' => 'superadmin.categoryDocs.show', 'uses' => 'SuperAdmin\CategoryDocController@show']);
    Route::get('superadmin/categoryDocs/{categoryDocs}/edit', ['as' => 'superadmin.categoryDocs.edit', 'uses' => 'SuperAdmin\CategoryDocController@edit']);
    //Document
    Route::get('superadmin/documents', ['as' => 'superadmin.documents.index', 'uses' => 'SuperAdmin\DocumentController@index']);
    Route::post('superadmin/documents', ['as' => 'superadmin.documents.store', 'uses' => 'SuperAdmin\DocumentController@store']);
    Route::get('superadmin/documents/create', ['as' => 'superadmin.documents.create', 'uses' => 'SuperAdmin\DocumentController@create']);
    Route::put('superadmin/documents/{documents}', ['as' => 'superadmin.documents.update', 'uses' => 'SuperAdmin\DocumentController@update']);
    Route::patch('superadmin/documents/{documents}', ['as' => 'superadmin.documents.update', 'uses' => 'SuperAdmin\DocumentController@update']);
    Route::delete('superadmin/documents/{documents}', ['as' => 'superadmin.documents.destroy', 'uses' => 'SuperAdmin\DocumentController@destroy']);
    Route::get('superadmin/documents/{documents}', ['as' => 'superadmin.documents.show', 'uses' => 'SuperAdmin\DocumentController@show']);
    Route::get('superadmin/documents/{documents}/edit', ['as' => 'superadmin.documents.edit', 'uses' => 'SuperAdmin\DocumentController@edit']);
//    Route::get('superadmin/readFile', ['as' => 'superadmin.documents.readFile', 'uses' => 'SuperAdmin\DocumentController@readFile']);
//    Route::get('superadmin/readFileSeperate', ['as' => 'superadmin.documents.readFileSeperate', 'uses' => 'SuperAdmin\DocumentController@readFileSeperate']);
//    Route::get('superadmin/readFileGrammar', ['as' => 'superadmin.documents.readFileGrammar', 'uses' => 'SuperAdmin\DocumentController@readFileGrammar']);


    Route::get('superadmin/documentCategories', ['as' => 'superadmin.documentCategories.index', 'uses' => 'Superadmin\DocumentCategoryController@index']);
    Route::post('superadmin/documentCategories', ['as' => 'superadmin.documentCategories.store', 'uses' => 'Superadmin\DocumentCategoryController@store']);
    Route::get('superadmin/documentCategories/create', ['as' => 'superadmin.documentCategories.create', 'uses' => 'Superadmin\DocumentCategoryController@create']);
    Route::put('superadmin/documentCategories/{documentCategories}', ['as' => 'superadmin.documentCategories.update', 'uses' => 'Superadmin\DocumentCategoryController@update']);
    Route::patch('superadmin/documentCategories/{documentCategories}', ['as' => 'superadmin.documentCategories.update', 'uses' => 'Superadmin\DocumentCategoryController@update']);
    Route::delete('superadmin/documentCategories/{documentCategories}', ['as' => 'superadmin.documentCategories.destroy', 'uses' => 'Superadmin\DocumentCategoryController@destroy']);
    Route::get('superadmin/documentCategories/{documentCategories}', ['as' => 'superadmin.documentCategories.show', 'uses' => 'Superadmin\DocumentCategoryController@show']);
    Route::get('superadmin/documentCategories/{documentCategories}/edit', ['as' => 'superadmin.documentCategories.edit', 'uses' => 'Superadmin\DocumentCategoryController@edit']);

//Offer Post
    Route::get('superadmin/offerPosts', ['as' => 'superadmin.offerPosts.index', 'uses' => 'SuperAdmin\OfferPostController@index']);
    Route::post('superadmin/offerPosts', ['as' => 'superadmin.offerPosts.store', 'uses' => 'SuperAdmin\OfferPostController@store']);
    Route::get('superadmin/offerPosts/create', ['as' => 'superadmin.offerPosts.create', 'uses' => 'SuperAdmin\OfferPostController@create']);
    Route::put('superadmin/offerPosts/{offerPosts}', ['as' => 'superadmin.offerPosts.update', 'uses' => 'SuperAdmin\OfferPostController@update']);
    Route::patch('superadmin/offerPosts/{offerPosts}', ['as' => 'superadmin.offerPosts.update', 'uses' => 'SuperAdmin\OfferPostController@update']);
    Route::delete('superadmin/offerPosts/{offerPosts}', ['as' => 'superadmin.offerPosts.destroy', 'uses' => 'SuperAdmin\OfferPostController@destroy']);
    Route::get('superadmin/offerPosts/{offerPosts}', ['as' => 'superadmin.offerPosts.show', 'uses' => 'SuperAdmin\OfferPostController@show']);
    Route::get('superadmin/offerPosts/{offerPosts}/edit', ['as' => 'superadmin.offerPosts.edit', 'uses' => 'SuperAdmin\OfferPostController@edit']);
//File
    Route::get('superadmin/files', ['as' => 'superadmin.files.index', 'uses' => 'Superadmin\FileController@index']);
    Route::post('superadmin/files', ['as' => 'superadmin.files.store', 'uses' => 'Superadmin\FileController@store']);
    Route::get('superadmin/files/create', ['as' => 'superadmin.files.create', 'uses' => 'Superadmin\FileController@create']);
    Route::put('superadmin/files/{files}', ['as' => 'superadmin.files.update', 'uses' => 'Superadmin\FileController@update']);
    Route::patch('superadmin/files/{files}', ['as' => 'superadmin.files.update', 'uses' => 'Superadmin\FileController@update']);
    Route::delete('superadmin/files/{files}', ['as' => 'superadmin.files.destroy', 'uses' => 'Superadmin\FileController@destroy']);
    Route::get('superadmin/files/{files}', ['as' => 'superadmin.files.show', 'uses' => 'Superadmin\FileController@show']);
    Route::get('superadmin/files/{files}/edit', ['as' => 'superadmin.files.edit', 'uses' => 'Superadmin\FileController@edit']);
    Route::post('superadmin/files/evaluated', ['as'=> 'superadmin.files.evaluated', 'uses' => 'Superadmin\FileController@evaluated']);
    Route::get('superadmin/files/offer/{files}', ['as' => 'superadmin.files.offer', 'uses' => 'Superadmin\FileController@offer']);
    Route::post('superadmin/files/offer', ['as'=> 'superadmin.files.edit_offer', 'uses' => 'Superadmin\FileController@edit_offer']);

//Sentence
    Route::get('superadmin/sentences', ['as' => 'superadmin.sentences.index', 'uses' => 'Superadmin\SentenceController@index']);
    Route::post('superadmin/sentences', ['as' => 'superadmin.sentences.store', 'uses' => 'Superadmin\SentenceController@store']);
    Route::get('superadmin/sentences/create', ['as' => 'superadmin.sentences.create', 'uses' => 'Superadmin\SentenceController@create']);
    Route::put('superadmin/sentences/{sentences}', ['as' => 'superadmin.sentences.update', 'uses' => 'Superadmin\SentenceController@update']);
    Route::patch('superadmin/sentences/{sentences}', ['as' => 'superadmin.sentences.update', 'uses' => 'Superadmin\SentenceController@update']);
    Route::patch('superadmin/sentences/{sentences}/update_high', ['as' => 'superadmin.sentences.update_high', 'uses' => 'Superadmin\SentenceController@update_high']);
    Route::delete('superadmin/sentences/{sentences}', ['as' => 'superadmin.sentences.destroy', 'uses' => 'Superadmin\SentenceController@destroy']);
    Route::get('superadmin/sentences/{sentences}', ['as' => 'superadmin.sentences.show', 'uses' => 'Superadmin\SentenceController@show']);
    Route::get('superadmin/sentences/{sentences}/edit', ['as' => 'superadmin.sentences.edit', 'uses' => 'Superadmin\SentenceController@edit']);
    Route::get('superadmin/sentences/{sentences}/edit_high', ['as' => 'superadmin.sentences.edit_high', 'uses' => 'Superadmin\SentenceController@edit_high']);

    Route::get('superadmin/documentFiles', ['as'=> 'superadmin.documentFiles.index', 'uses' => 'Superadmin\DocumentFileController@index']);
    Route::post('superadmin/documentFiles', ['as'=> 'superadmin.documentFiles.store', 'uses' => 'Superadmin\DocumentFileController@store']);
    Route::get('superadmin/documentFiles/create', ['as'=> 'superadmin.documentFiles.create', 'uses' => 'Superadmin\DocumentFileController@create']);
    Route::put('superadmin/documentFiles/{documentFiles}', ['as'=> 'superadmin.documentFiles.update', 'uses' => 'Superadmin\DocumentFileController@update']);
    Route::patch('superadmin/documentFiles/{documentFiles}', ['as'=> 'superadmin.documentFiles.update', 'uses' => 'Superadmin\DocumentFileController@update']);
    Route::delete('superadmin/documentFiles/{documentFiles}', ['as'=> 'superadmin.documentFiles.destroy', 'uses' => 'Superadmin\DocumentFileController@destroy']);
    Route::get('superadmin/documentFiles/{documentFiles}', ['as'=> 'superadmin.documentFiles.show', 'uses' => 'Superadmin\DocumentFileController@show']);
    Route::get('superadmin/documentFiles/{documentFiles}/edit', ['as'=> 'superadmin.documentFiles.edit', 'uses' => 'Superadmin\DocumentFileController@edit']);

    Route::get('superadmin/labelTypes', ['as'=> 'superadmin.labelTypes.index', 'uses' => 'Superadmin\LabelTypeController@index']);
    Route::post('superadmin/labelTypes', ['as'=> 'superadmin.labelTypes.store', 'uses' => 'Superadmin\LabelTypeController@store']);
    Route::get('superadmin/labelTypes/create', ['as'=> 'superadmin.labelTypes.create', 'uses' => 'Superadmin\LabelTypeController@create']);
    Route::put('superadmin/labelTypes/{labelTypes}', ['as'=> 'superadmin.labelTypes.update', 'uses' => 'Superadmin\LabelTypeController@update']);
    Route::patch('superadmin/labelTypes/{labelTypes}', ['as'=> 'superadmin.labelTypes.update', 'uses' => 'Superadmin\LabelTypeController@update']);
    Route::delete('superadmin/labelTypes/{labelTypes}', ['as'=> 'superadmin.labelTypes.destroy', 'uses' => 'Superadmin\LabelTypeController@destroy']);
    Route::get('superadmin/labelTypes/{labelTypes}', ['as'=> 'superadmin.labelTypes.show', 'uses' => 'Superadmin\LabelTypeController@show']);
    Route::get('superadmin/labelTypes/{labelTypes}/edit', ['as'=> 'superadmin.labelTypes.edit', 'uses' => 'Superadmin\LabelTypeController@edit']);

    Route::get('superadmin/fileUsers', ['as'=> 'superadmin.fileUsers.index', 'uses' => 'Superadmin\FileUserController@index']);
    Route::post('superadmin/fileUsers', ['as'=> 'superadmin.fileUsers.store', 'uses' => 'Superadmin\FileUserController@store']);
    Route::get('superadmin/fileUsers/create', ['as'=> 'superadmin.fileUsers.create', 'uses' => 'Superadmin\FileUserController@create']);
    Route::put('superadmin/fileUsers/{fileUsers}', ['as'=> 'superadmin.fileUsers.update', 'uses' => 'Superadmin\FileUserController@update']);
    Route::patch('superadmin/fileUsers/{fileUsers}', ['as'=> 'superadmin.fileUsers.update', 'uses' => 'Superadmin\FileUserController@update']);
    Route::delete('superadmin/fileUsers/{fileUsers}', ['as'=> 'superadmin.fileUsers.destroy', 'uses' => 'Superadmin\FileUserController@destroy']);
    Route::get('superadmin/fileUsers/{fileUsers}', ['as'=> 'superadmin.fileUsers.show', 'uses' => 'Superadmin\FileUserController@show']);
    Route::get('superadmin/fileUsers/{fileUsers}/edit', ['as'=> 'superadmin.fileUsers.edit', 'uses' => 'Superadmin\FileUserController@edit']);
});

//Route::group(['middleware' => ['auth.admin']], function () {
//    Route::get('admin/dashboard', ['as' => 'admin.dashboard.index', 'uses' => 'Admin\DashboardController@index']);
//
//});

Route::get('/tai-lieu', ['as' => 'documents', 'uses' => 'Frontend\DocumentController@index']);
Route::get('/files/{files}', ['as' => 'files.show', 'uses' => 'Frontend\FileController@show']);
Route::get('/files_corpus', ['as' => 'files', 'uses' => 'Frontend\FileController@index']);
Route::get('/danh-muc-corpus', ['as' => 'categoryDoc', 'uses' => 'Frontend\CategoryDocumentController@index']);