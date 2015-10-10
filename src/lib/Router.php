<?php
/**
 * Fastpress  | A fast, simple PHP micro-framework.
 *
 * @author    Simon Daniel <samayo@gmail.com>
 * @link      https://github.com/fastpress/fastpress
 * @copyright Copyright (c) 2013 Simon Daniel
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
namespace Fastpress;
use Psr\Http\Message\ServerRequestInterface;

/**
 * An HTTP Router Object
 *
 * @category    Fastpress
 * @package     Router
 * @version     0.1.0
 */
class Router{

    protected $routes = [
        'GET'    => [],
        'POST'   => [],
        'ANY'    => [],
        'PUT'    => [],
        'DELETE' => [],
    ];

    public $patterns = [
        ':any'  => '.*',
        ':id'   => '[0-9]+',
        ':slug' => '[a-z-0-9\-]+',
        ':name' => '[a-zA-Z]+',
    ];

    const REGVAL = '/({:.+?})/';

    public function any($path, $handler){
        $this->addRoute('GET', $path, $handler);
        $this->addRoute('POST', $path, $handler);
        $this->addRoute('PUT', $path, $handler);
        $this->addRoute('DELETE', $path, $handler);
    }

    public function get($path, $handler){
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler){
        $this->addRoute('POST', $path, $handler);
    }

    public function put($path, $handler){
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete($path, $handler){
        $this->addRoute('DELETE', $path, $handler);
    }

    protected function addRoute($method, $path, $handler){
        array_push($this->routes[$method], [$path => $handler]);
    }

    public function match(ServerRequestInterface $request){
        $requestMethod = $request->getMethod();
        $requestUri = $request->getUri()->getPath();
        $restMethod = $this->getRestfullMethod($request);

        #@TODO: Implement REST method.

        if (!$restMethod && !in_array($requestMethod, array_keys($this->routes))) {
            return FALSE;
        }

        $method = $restMethod ?: $requestMethod;

        foreach ($this->routes[$method]  as $resource) {

            $args    = [];
            $route   = key($resource);
            $handler = reset($resource);

            if(preg_match(self::REGVAL, $route)){
                list($args, $uri, $route) = $this->parseRegexRoute($requestUri, $route);
            }

            if(!preg_match("#^$route$#", $requestUri)){
                unset($this->routes[$method]);
                continue ;
            }

            if(is_string($handler) && strpos($handler, '@')){
                list($ctrl, $method) = explode('@', $handler);
                return ['controller' => $ctrl, 'method' => $method, 'args' => $args];
            }

            if (empty($args)){
                return $handler($request);
            }

            #TODO: pass app by func array_push($args, $this);
            return call_user_func_array($handler, array($request));

        }

        if(!headers_sent()){
            header('HTTP/1.1 404');
            exit;
        }
    }

    protected function getRestfullMethod($postVar){
        if(array_key_exists('_method', $postVar)){
            if(in_array($method, array_keys($this->routes))){
                return $method;
            }
        }
    }

    protected function parseRegexRoute($requestUri, $resource){
        $route = preg_replace_callback(self::REGVAL, function($matches) {
            $patterns = $this->patterns;
            $matches[0] = str_replace(['{', '}'], '', $matches[0]);

            if(in_array($matches[0], array_keys($patterns))){
                return  $patterns[$matches[0]];
            }

        }, $resource);


        $regUri = explode('/', $resource);

        $args = array_diff(
            array_replace($regUri,
                explode('/', $requestUri)
            ), $regUri
        );

        return [array_values($args), $resource, $route];
    }
}
