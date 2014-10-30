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

Route::get('/sandbox', function(){

	return "sandbox page do whatever";
});

Route::get('/list/{format?}', function($format=null){

	if(strtolower($format=='json')) return "json format here";

	//by default send the html view
	return View::make('list')->with('foo', 'adi');//"list all the books for $format";
});

Route::get('/add', function(){
	$book = new Book();

	$book->title = "Hackers and painters";
	$book->author="Paul Graham";
	$book->save();

	return "created a book :)";
});

Route::get('/read', function(){

	$books = Book::where('author', 'LIKE', '%paul%')->get(); //Book::all();

	return Paste\Pre::r($books);

});

Route::get('/update', function() {

    # First get a book to update
    $book = Book::where('author', 'LIKE', '%paul%')->first();

    # If we found the book, update it
    if($book) {

        # Give it a different title
        $book->title = 'The Really Great Gatsby';

        # Save the changes
        $book->save();

        return "Update complete; check the database to see if your update worked...";
    }
    else {
        return "Book not found, can't update.";
    }

});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo Pre::render($results);

});

Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('/hello', function(){
	return "hello world";

});

# /app/routes.php
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
