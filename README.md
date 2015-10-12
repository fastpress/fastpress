# fastpress 

Fastpress is ultra-fast and simple blogging app made primarly for developers

Install
-----
Using git
```bash
$ git clone https://github.com/fastpress/fastpress.git
```
Using composer
```bash
$ php composer.phar require fastpress/fastpress:0.0.*
```
Or [download it manually][fastpress_releases] based on the archived version of release-cycles.
```


Basic usage
-----
```php
// src/app/bootstrap.php
require __DIR__ . "/../Autoload.php";

$app->get("/hello/{:name}", function($name) use ($app){
  echo "Hello " $app->escape($name); 
});

$app->run();
```

##### simple blog-fetch example 
```php
$app->get("/blog/{:slug}", function($slug) use ($app, $blogRepository){
   $blog = $blogRepository->getBySlug($slug); 

   if(!$blog){
      $app["response"]->setHeader(404, "Not Found")
   }

   $app->view("page.blogs", ["blog" => $blog]); 
});
```

##### simple login example
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
         $app["session"]->set("user", md5($email));
         $app["response"]->redirect("/secure-page")
      }
   }

  $app->view("page.login", ["error" => $error]); 
});
```

##### basic mvc example
Route
```php 
# Route
# in src/app/bootstrap.php
(new Fastpress\Application)
  ->get("/user/{:name}", "UserController@index")
  ->post("/register", "UserController@register")
->run(); 

# Controller
# in app/controller/UserController.php 
namespace App\Controller; 
class UserController{
  public function index($args, $app){
    echo "Hello " . $app->escape($args["name"]); 
  }
}
```

##### Configuration
All configuration is done in /src/app/dev.conf.php and looks something like this
```php 
// default page metadata
$app["page"] = [
   "title"        => "Your page title!",
   "keywords"     => "site, keywords, here ..",
   "description"  => "site description", 
   "image"        => __HOST__ . "/images/thumbnail.png"
];


// database details 
$app["database"] = [
   "driver"     => "mysql",
   "host"       => "localhost",
   "database"   => "",
   "username"   => "",
   "password"   => "",
   "charset"    => "utf8",
   "collation"  => "utf8_unicode_ci",
   "prefix"     => "",
];
```
You can use the `$app->app()` method to add/override any these configs in your app.
```php
# go to url http://your-host/blog/why-php-rocks
$app->get("/blog/{:slug}", function($slug) use ($app){  
  // set page title to:  "why-php-rocks"
  $app->app("page:title", $slug); 

  $app->app("cache:page", $app->getUri()); #@TODO
});
```

##### Adding classes / libs 
Using other (or your own custom) lib/class is as simple as shown here. 
If you are not using composer, just drop its anywhere in `/src/lib/`
```php
// let"s include a class called Autolog.php it has its own folder called "Logger"
// so now we have /src/lib/Logger/autolog.php | to use it, do:
use Fastpress\Logger\Autolog as Log; 

$app->any("/blog/{:id}", function($id) use ($app){
  if($app->isPost()){
    $username = $app->postVar("username"); 
    $comment  = $app->postVar("comment"); 
    $email    = $app->postVar("email", FILTER_VALIDATE_EMAIL);
    
    if($username && $comment && $email){
      // .. database stuff .. 
      $user = $app->escape($username);
      return (new Log)
        ->log(" $user just commented on page " . $app->getUri(), Log::EMAIL, log::INFO);
    }
  }
});

# If you don't want to instantiate objects? Namespace it in `/lib/container.php` and use it as 
$app["log"]->log("$user just commented on page.", "EMAIL", "INFO");
```



[fastpress_releases]: http://github.com/fastpress/fastpress/releases