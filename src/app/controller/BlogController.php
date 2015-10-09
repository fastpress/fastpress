<?php 

namespace App\Controller; 

class BlogController{
	public function slug($args, $app){
		echo 'URL is /mvc/'. $args[0];
	}
}