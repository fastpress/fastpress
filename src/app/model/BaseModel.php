<?php


namespace App\Model;
use \PDO; 

class BaseModel{
    protected  $pdo; 

    public function __construct(){
    	
    	$options = [
            PDO::ATTR_EMULATE_PREPARES => false, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        
        $this->pdo = new PDO("mysql:host=localhost; dbname=fastpress_app", "root", "samayo",  $options);
    }
}
