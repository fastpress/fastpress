<?php 

namespace App\Controller; 
use App\Model\BlogRepository as Blog; 

class BlogController{
	public function index($args, $app){
		$blog = Blog::init($app['database']); 

		$blogs = Blog::getAll();

		$app['view']->view('home', ['blogs' => $blogs]);
	}
}


