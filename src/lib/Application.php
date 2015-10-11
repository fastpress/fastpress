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
 * A Application Class
 *
 * This class only makes it easier to call the other classes 
 * and thier methods, other than that .. it has no use. 
 *
 * @category    Fastpress
 * @package     Application
 * @version     0.1.0
 */
Class Application extends Container{
    private $isBooted = FALSE; 

  
    public function escape($text){
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
    
    public function server($var, $filter = NULL){
        $request = new Request();
        return $request->server($var, $filter);
        #return $this['request']->server($var, $filter);
    }

    public function isGet(){
        $request = new Request($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
        return $request->isGet();
        #return $this['request']->isGet();  
    }
    
    public function isPost(){
        $request = new Request($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
        return $request->isPost();
        #return $this['request']->isPost();
    }
    
    public function isPut(){
        $request = new Request($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
        return $request->isPut();
        #return $this['request']->isPut(); 
    }
    
    public function isDelete(){
        $request = new Request($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
        return $request->isDelete();
        #return $this['request']->isDelete();
    }

    public function app($key, $value = null){
        if(null === $value){
            return $this->offsetGet($key); 
        }

        $this->offsetSet($key, $value); 
    }

    public function setResponse($header = 200, $statusText = null){
        $request = new Response();
        return $request->setResponse($header, $statusText);
        #$this['response']->setResponse($header, $statusText);
    }

    public function getVar($value, $filter = null){
        $request = new Request($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
        $request->get($value, $filter);
        #return $this['request']->get($value, $filter); 
    }

    public function postVar($value, $filter = null){
        $request = new Request($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
        $request->post($value, $filter);
        #return $this['request']->post($value, $filter); 
    }

    public function any($path, $resource){
        $this->isBooted = TRUE;
        $router = new Router; 
        return $router->any($path, $resource);
        #return $this['route']->any($path, $resource);
    }

    public function get($path, $resource){
        $this->isBooted = TRUE;
        $router = new Router;
        return $router->get($path, $resource);
        #return $this['route']->get($path, $resource);
    }

    public function post($path, $resource){
        $router = new Router; 
        return $router->post($path, $resource);
        #return $this['route']->post($path, $resource);
    }

    public function put($path, $resource){
        $router = new Router; 
        return $router->put($path, $resource);
        #return $this['route']->put($path, $resource);
    }

    public function delete($path, $resource){
        $router = new Router; 
        return $router->delete($path, $resource);
        #return $this['route']->delete($path, $resource);
    }


    private function controllerDipatcher($resource){
        $controller = $resource['controller']; 
        $method     = $resource['method']; 
        $args       = $resource['args']; 

        $fullyQualifiedServiceName = "App\Controller\\".$resource['controller']; 
        
        if(class_exists($fullyQualifiedServiceName)){
            $controller = new $fullyQualifiedServiceName; 
            if(!method_exists($controller, $method)){
                throw new \Exception("method $method does not exists in $fullyQualifiedServiceName"); 
            }else{
                (new $controller)->$method($args, $this);
            }
        }else{
            throw new \Exception("controller $controller does not exist");
            
        }
    }

    public function view($block, array $variables = []){
        $view = new Template($this); 
        $view->view($path, $resource);
        #$this['view']->view($block, $variables);
    }

    public function layout($layout, array $variables = []){
        $view = new Template($this);
        $view->layout($layout, $variables); 
        #$this['view']->layout($layout, $variables);
    }

    public function run(){
        $router = new Router; 
        $resource = $router->match($_SERVER, $_POST); 
        #$resource = $this['route']->match($_SERVER, $_POST);  
        if(is_array($resource)){
            $this->controllerDipatcher($resource);
        }
    }
}

