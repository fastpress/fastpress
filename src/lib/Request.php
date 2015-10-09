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

/**
 * An HTTP Request Object
 *
 * @category    Fastpress
 * @package     Request
 * @version     0.1.0
 */
class Request{
    protected $get;
    protected $post;
    protected $server;
    protected $files;
    protected $cookies;

    public function __construct(
        array $_get, 
        array $_post, 
        array $_files, 
        array $_server, 
        array $_cookies
    ){
        $this->get = $_get;
        $this->post = $_post; 
        $this->files = $_files; 
        $this->server = $_server;
        $this->cookies = $_cookies;
    }

    public function isGet(){
        return $this->getMethod() == 'GET'; 
    }
    
    public function isPost(){
        return $this->getMethod() == 'POST'; 
    }
    
    public function isPut(){
        return $this->getMethod() == 'PUT'; 
    }
    
    public function isDelete(){
        return $this->getMethod() == 'DELETE'; 
    }

    public function get($var, $filter = null){
        return $this->filter($this->get, $var, $filter);
    }

    public function post($var, $filter = null){
        return $this->filter($this->post, $var, $filter);
    }

    public function server($var, $filter = null){
        return $this->filter($this->server, $var, $filter);
    }
    
    public function getUri(){
        return $this->filter($this->server, 'REQUEST_URI');
    }
    
    public function getReferer(){
        return $this->filter($this->server, 'HTTP_REFERER');
    }

    public function getMethod(){
        return $this->filter($this->server, 'REQUEST_METHOD');
    }

    public function isSecure(){
       return (array_key_exists('HTTPS', $this->server)
            && $this->server['HTTPS'] !== 'off'
        );
    }

    public function isXhr(){
        return $this->filter($this->server, 'REQUEST_METHOD') === 'XMLHttpRequest';
    }

    protected function filter($input, $var, $filter = null){
        $value = isset($input[$var]) ? $input[$var] : FALSE;
        
        if (!$filter) {
            return $value;  
        }
        
        return filter_var($value, $filter);
    }
} 