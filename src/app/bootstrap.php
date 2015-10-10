<?php
/**
 * Bootstrap - start your application here.
 *
 * PHP version 5.4
 */

require __DIR__ . "/../../vendor/autoload.php";
session_start();

$app = new Fastpress\Application();

$app->get('/', function() {
    echo 'root';
});

$app->get('/sub', function() {
    echo 'sub';
});

$app->run();

