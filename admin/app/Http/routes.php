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
Route::auth();
Route::group(['middleware' => 'auth'], function () {
  Route::get('/', function () {
    return view('layout.dashboard');
      
  });
  Route::get('/users', function () {
      return view('user.index');
});
Route::get('/categories', function () {
      return view('category.index');
});
Route::get('/tags', function () {
      return view('tags.index');
});
Route::get('/topics', function () {
      return view('topics.index');
});
Route::get('/images', function () {
      return view('images.index');
});
Route::get('/configuration','ConfigurationController@index');
Route::post('/configuration', 'ConfigurationController@store');
Route::get('/createcroppopup', 'ImageController@createcroppopup');
Route::get('/createcroptinymce', 'ImageController@createcroptinymce');
Route::get('/viewlist', 'ImageController@viewlist');
Route::get('searchviewlist/{title}', 'ImageController@searchviewlist');
Route::get('/listtinymce', 'ImageController@listtinymce');
Route::get('searchlisttinymce/{title}', 'ImageController@searchlisttinymce');
Route::group(['middleware' => ['web']], function () {
    Route::resource('user', 'UserController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('category', 'CategoryController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('topic', 'TopicController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('tag', 'TagController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('image', 'ImageController');
    Route::post('/image/{id}', 'ImageController@modify');
});


Route::get('/categoryListData', 'WebserviceController@categoryListData');
Route::get('/topicsListData', 'WebserviceController@topicsListData');
Route::get('/usersListData', 'WebserviceController@usersListData');
Route::get('/tagsListData', 'WebserviceController@tagsListData');
Route::resource('content', 'ContentController');
// Templates
Route::group(array('prefix'=>'/layout/'),function(){
    Route::get('{template}', array( function($template)
    {
        $template = str_replace(".html","",$template);
        View::addExtension('html','php');
        return View::make('layout.'.$template);
    }));
});




 Route::get('/home', function () {
        return view('layout.dashboard');
  });
});

