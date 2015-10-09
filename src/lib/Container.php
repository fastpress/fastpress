<?php
/**
 * FASTPRESS  | A fast PHP microframework
 *
 * @author      Sim. Daniel <samayo@gmail.com>
 * @link        https://github.com/fastpress/fastpress
 * @copyright   Copyright (c) 2013 SD
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */
namespace Fastpress;

/**
 * A Container Class
 *
 * @category    Fastpress
 * @package     Container
 * @version     0.1.0
 */
use Fastpress\Request;
use Fastpress\Response;
use Fastpress\Router;
use Fastpress\Session;
use Fastpress\Database;
use Fastpress\Template;
use Fastpress\Auth\User; 
use Fastpress\Autolog as Autolog;


class Container implements \ArrayAccess{
    protected $container = array();
    
  public function __construct($conf){
		$app = $this; 
        
        if(file_exists($conf)){
            require $conf;
        }
        
        $this['route'] = $this->store(function(){
            return new Router;
        });

        $this['view'] = $this->store(function($conf){
            return new Template($conf['path'], $this);
        });

        $this['request'] = $this->store(function(){
            return new Request(
                $_GET, $_POST, $_FILES, $_SERVER, $_COOKIE
            );
        });

        $this['response'] = $this->store(function(){
            return new Response();
        });

        $this['session'] = $this->store(function($conf){
            return new Session($conf['app.session']);
        });




    }

    public function offsetUnset($offset){}
    
    public function offsetGet($offset){
        if(array_key_exists($offset, $this->container) && 
            is_callable($this->container[$offset])){
            return $this->container[$offset]();
        }

        return $this->container[$offset];
    }
    
    public function offsetExists($offset){
        return array_key_exists($id, $this->container);
    }

    public function offsetSet($offset, $value){
        if(strpos($offset, ':')){
            list($index, $subset) = explode(':', $offset, 2); 
            $this->container[$index][$subset] = $value; 
        }
        
        $this->container[$offset] = $value;
    }


    public  function store(Callable $callable){
        return function () use ($callable){
            static $object; 

            if(null == $object){
                $object = $callable($this->container); 
            }

            return $object;
        }; 
    }

}


