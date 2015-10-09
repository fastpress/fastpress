# fastpress 

> Obsolete version

### INSTALL
Using Composer
```bash 
# Composer 
$ composer require fastpress/fastpress:0.1.*;
```

##### configuration
All application-level configs are done in this file `src/app/conf.dev.php` 

#### USAGE
Simple Hello world example
```php
# in src/app/bootstrap.php
require __DIR__ . '/../Autoload.php';
$app = new Fastpress\Application;

# go to http://your-host/hello/world
$app->get('/hello/{:name}', function($name) use ($app){
  echo 'Hello ' $app->escape($name);  // Hello world
});

$app->run();
```

##### simple blog example 
Sintra-inspired syntactic sugar
```php
$app->get('/blog/{:slug}', function($slug) use ($app, $blogRepository){
  $blog = $blogRepository->getBySlug($slug); 

    if(!$blog){
      $app['response']->response(404, 'Not Found')
    }

    $app->view("page.blogs", ["blog" => $blog]); 
});
```

##### login example
```php
$app->any("/login", function() use ($app){
  $error = null; 

  if($app->isPost()){
    $email = $app->postVar("email", FILTER_VALIDATE_EMAIL);
    $pass  = $app->postVar("password"); 

    if(!$email || !$pass){
      $error = "email and password is required"; 
    }
    
    if(!$error){
      $app['session']->app("user", md5($email));
      $app['response']->redirect('/secure-page')
    }
  }

  $app->view("page.login", ["error" => $error]); 
});
```

##### mvc example
Route
```php 
$app->get('/your-route', 'controller@method'); 
```
Controller
```php 
// in src/app/bootstrap.php
(new Fastpress\Application)
  ->get('/user/{:name}', 'UserController@index')
  ->post('/register', 'UserController@register')
->run(); 

// app/controller/UserController.php 
namespace App\Controller; 
class UserController{
  public function index($args, $app){
    echo "Hello " . $app->escape($args['name']); // hello name
  }
}
```

##### Global settings access
You can use the `$app` or `$app->app()` method to add/override any config in your app.
```php
# go to url http://your-host/blog/why-php-rocks
$app->get('/blog/{:slug}', function($slug) use ($app){  
  // set page title to:  'why-php-rocks'
  $app->app("page:title", $slug); 
  // don't need to use adsense for this page? 
  $app->app("use:adsense", false); 
  // or hide the sidebar? 
  $app->app("block:sidebar", false);

  $app->app("cache:page", $app->getUri()); #@TODO
});
```

##### Adding classes / libs 
Using other (or your own custom) lib/class is as simple as shown here. 
If you are not using composer, just drop its anywhere in `/src/lib/`
```php
// let's include a class called Autolog.php it has its own folder called 'Logger'
// so now we have /src/lib/Logger/autolog.php | to use it, do:
use Fastpress\Logger\Autolog as Log; 

$app->any('/blog/{:id}', function($id) use ($app){
  if($app->isPost()){
    $username = $app->postVar('username'); 
    $comment  = $app->postVar('comment'); 
    $email    = $app->postVar('email', FILTER_VALIDATE_EMAIL);
    
    if($username && $comment && $email){
      // .. database stuff .. 
      $user = $app->escape($username);
      return (new Log)
        ->log(" $user just commented on page " . $app->getUri(), Log::EMAIL, log::INFO);
    }
  }
});
```
Don't want to instantiate objects? Namespace it in `/lib/container.php` and use it as 
```php
$app['log']->log("$user just commented on page.", 'EMAIL', 'INFO');
```

##### Views and template-inheritance 
Fastpress supports template inheritance-like feature
```php
// If the URL is a match, This will include the file '/views/user.profile.php'
$app->get('/pages/contact', function() use ($app){
  $app->view('user.profile', ['url' => $app['request]->getUri());
})
```
That file is a block file, that extends a main layout page, so you must describe 
which layout you want to extend in the file (user.profile.php)
```php
// in app/views/user.profile.php
<?php $this->extend('master')->block('block:content') ?>
<h3> I'm inside the layout now overriding content div </h3>
This page's URL is: <?= $url ?>
<!-- make sure to close the buffer using endBlock();  -->
<?php  $this->endBlock(); ?>
```



