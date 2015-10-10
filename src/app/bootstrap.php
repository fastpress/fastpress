<?php
/**
 * Bootstrap - start your application here.
 *
 * PHP version 5.4
 */

use Psr\Http\Message\ServerRequestInterface;

require __DIR__ . "/../../vendor/autoload.php";
session_start();

$app = new Fastpress\Application();

$app->get('/', function(ServerRequestInterface $request) {
    echo <<<TAG
<form method="post" action="post">
<input type="text" name="textinput" value="xxxxx">
<button type="submit">POST</button>
</form>
TAG;
});

$app->get('/sub', function(ServerRequestInterface $request) {
    echo $request->getUri()->getPath();
});


$app->post('/post', function(ServerRequestInterface $request) {
    echo "POST data:<br>\n";
    var_dump($request->getParsedBody());
});

$app->run();

