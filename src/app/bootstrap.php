<?php
/**
 * Bootstrap - start your application here. 
 *
 * PHP version 5.4
 */
 
require __DIR__ . "/../Autoload.php";
session_start();

$conf =  __DIR__ . "/conf.dev.php";
$app = new Fastpress\Application($conf);

# THIS SHOULD BE IN ANOTHER CLASS. ex: /src/app/model
try{
	$pdo = new PDO('mysql:host=localhost; dbname=****', '****', '****');
	$stmt = $pdo->query("SELECT title, slug, tags, content, date_added, DATE_FORMAT(date_added, '%W %m, %Y') as day_name FROM blogs"); 
    $blogs = $stmt->fetchAll(\PDO::FETCH_ASSOC);      
}catch(PDOException $e){
	echo $e->getMessage();
}


$app->get('/', function() use ($app, $blogs){
	$app->view('page.home', ['app'=>$app, 'blogs' => $blogs]);
});


# other farmework-specific examples

# hello world
$app->get('/hello', function(){
	echo ' hello';
});

# with named args ex: /name/<script>
$app->get('/name/{:any}', function($name) use ($app){
	echo 'your name is ' . $app->escape($name); // your name is %3Cscript%3E
});

# mvc example
$app->get('/mvc', 'HomeController@index');

# mvc with named args
$app->get('/mvc/{:slug}', 'BlogController@slug');

$app->post('/', function(){
	echo 'this is post request on url /';
});

$app->any('/login', function() use ($app){
	if($app->isPost()){
		// form is submitted, intialize login
	}
});


$app->run();

