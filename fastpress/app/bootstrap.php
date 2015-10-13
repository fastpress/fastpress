<?php
/**
 * Bootstrap - start your application here. 
 *
 * PHP version 5.4
 */
 
require __DIR__ . "/../../vendor/autoload.php";
session_start();

$conf =  __DIR__ . "/conf.dev.php";
var_dump(class_exists('\Torpedo\Application'));
$app = new Fastpress\Application($conf);




$blogRepository = new App\Model\BlogRepository;
$userRepository  = new App\Model\UserRepository;

$user = new Fastpress\Auth\User($app['session']);

$app->get('/', function()  use ($blogRepository, $app){
	$blogs = $blogRepository->getAll(); 

	if(!$blogs){
		throw new \Exception('no blogs found');
	}

	$app->view('page.home', ['app'=>$app, 'blogs' => $blogs]);
});


$app->get('/blog/{:slug}', function($slug) use ($blogRepository, $app){
		$app->app('block:sidebar', false);
		$app->app('block:header', false);
		
		$blog = $blogRepository->getBySlug($slug); 

		$app->view('page.show-blog', ['app'=>$app, 'blog' => $blog]);
});




$app->any('/login', function() use($app, $userRepository, $user){
	$error = null; 


	if($app->isPost()){
		$email = $app->postVar('email', FILTER_VALIDATE_EMAIL);
		$password = $app->postVar('password'); 

		if(!$email || !$password){
			$error = "email and password is required"; 
		}

		if(!$error){
			$user = $userRepository->loginAuth($email, $password); 
			if($user){
				$app['session']->set('user', $user);
				$app['session']->set('flash', 'Login success!');
				$app['response']->redirect('/message');
			}else{
				$error = "invalid email/password combination";
			}
		}
	}
	
	

	$app->view('page.login', ['error' => $error]); 

});

$app->get('/logout', function() use ($app){
	$app['session']->destroy();
	$app['response']->redirect('/');
});

$app->get('/register', function() use ($app){
	 $app->view('page.register'); 
});


$app->post('/register', function() use ($app, $userRepository){

	 $error = null; 
	 
	 $username = $app->postVar('username', FILTER_SANITIZE_STRING); 
	 $email    = $app->postVar('email', FILTER_VALIDATE_EMAIL); 
	 $password = $app->postVar('password', FILTER_SANITIZE_STRING); 
	 $password = password_hash($password, PASSWORD_DEFAULT);

	 if(!$username || !$email || !$password){
	 	$error = 'Username, email and password fields are required'; 
	 }

	 if(!$error){
	 	$newUser = $userRepository->addUser([
	 		'username' => $username, 
	 		'email'    => $email, 
	 		'password' => $password
	 	]);

	 	if($newUser){
	 		$app['session']->set('flash', 'you have registered, check your inbox to activate your account');
	 		$app['response']->redirect('/message');
	 	}
	 }

	 $app->view('page.register', ['error' => $error]); 
});


$app->get('/message', function() use ($app, $user){

	if(!$app['session']->get('flash')){
		$app->setResponse(404, 'NOT ALLOWED');
	}
	echo $app['session']->get('flash');

	echo "click here <a href='/'> to go to main poge</a> ";
});

 

$app->any('/publish', function() use ($app, $blogRepository, $user){
	$app->app('block:sidebar', false);
	if (!$user->isAdmin()) { 
		 $app['response']->redirect('/login'); 
	}

	$error = null; 
	
	if($app->isPost()){
		$title   = $app->postVar('title', FILTER_SANITIZE_STRING); 
		$tags    = $app->postVar('tags', FILTER_SANITIZE_STRING); 
		$content = $app->postVar('content'); 

		if(!$title || !$tags || !$content){
			$error = "Title, Tags and Content are requried"; 
		}


		if(!$error){
			$addBlog = $blogRepository->addBlog([
				'tags' => $tags, 
				'title' => $title, 
				'content' => $content
			]);
		}
	}

	$app->view('page.post', ['error' => $error]); 
});


$app->get('/install', function(){
	echo 'not yet implemented'; 
});


$app->get('/blogs\/[\?a-z]{2,80}\=[a-z\-]{2,80}', function( ) use ($app, $blogRepository){
	
	$tag = $app->getVar('tag'); 

	echo 'looking for articles with tag: '. $tag;

	if($tag){
		$result = $blogRepository->getByTags($tag); 
		$app->view('search.blogs', ['searchResult' => $result]);
	}
	 
});

$app->post('/comments', function(){
	echo 'not yet implemented'; 
});

$app->post('/blog/{:slug}', function(){});

$app->get('/admin', function(){
	echo 'Not yet implemented!';
});

$app->run();

