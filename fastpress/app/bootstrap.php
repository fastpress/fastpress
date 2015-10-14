<?php
/**
 * Bootstrap - start your application here. 
 *
 * PHP version 5.4
 */
 
require __DIR__ . "/../../vendor/autoload.php";
session_start();

$conf =  __DIR__ . "/conf.dev.php";

$app = new Torpedo\Application($conf);

$app->any('/', function() use ($app){
	echo "
		hello. <p> 
		try these routes, until we test everything to make sure all is ok <br/><br/>
		1 - /name/{:name} --- pass any name to url /name/<br/>
		2 - /mvc-example -- check if MVC example is working
		<form method='post'><input type='submit' value='3 -check post request'> </form>  <br/>
	";

	if($app->isPost()){
		echo '<br> THIS IS A POST REQUEST <br/>'; 
	}
});

# named args example
$app->get('/name/{:name}', function($name) use ($app){
	echo 'this is your sanitized name: ' . $app->escape($name);
});

# mvc example
$app->get('/mvc-example', 'DefaultController@index');

$app->run();

