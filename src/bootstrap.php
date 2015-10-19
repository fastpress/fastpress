<?php
/**
 * Bootstrap - start your application here. 
 *
 * PHP version 5.4
 */

session_start();
require __DIR__ . "/../vendor/autoload.php";
$conf =  __DIR__ . "/conf.dev.php";

$app = new Fastpress\Application($conf);

$app->get('/', 'BlogController@index');
// $app->get('/login', 'AccessController@login');
// $app->get('/register', 'AccessController@login');
// $app->get('/logout', 'AccessController@login');

// $app->get('/about', 'PageController@about');
// $app->get('/contact', 'PageController@contact');

// $app->get('/{:slug}', 'BlogController@showBySlug');
// $app->post('/{:slug}', 'BlogController@submitComment');

$app->run();