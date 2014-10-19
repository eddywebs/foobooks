<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	//return "welcome to foobooks";
	return View::make('_master');
});

Route::get('/books/{genre}', function($genre)
{
    return "Books in the {$genre} category.";
});

Route::get('/data', function(){

	$library = new library();
	$library->books="some books";
	return $library->books;
});

Route::get('/list/{format?}', function($format=null){

	if(strtolower($format=='json')) return "json format here";

	//by default send the html view
	return View::make('list')->with('foo', 'adi');//"list all the books for $format";
});

Route::post('/add', function(){
	return "add post";

});


Route::get('/hello', function(){
	return "hello world";

});
