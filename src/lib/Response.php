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
 * An HTTP Response Object
 *
 * @category    Fastpress
 * @package     Response
 * @version     0.1.0
 */
class Response{
    private $statusCode = 200;
    private $statusText = 'OK';
    private $headers    = [];
    private $protocol   = 'HTTP/1.1';
    private $body;

    public function setResponse($statusCode = 200, $statusText = 'OK'){
        $this->statusCode = $statusCode; 
        $this->statusText = $statusText;
        $this->render();  
    }

    public function setBody($body){
        $this->body = $body;
        return $this;
    }
    
    public function addHeader($name, $value){
        $this->headers[$name] = (string) $value;
        return $this; 
    }
    
    public function setStatus($statusCode){
        if($statusCode < 100 || $statusCode > 599){
            throw new \LogicException(sprintf(
                '%s is unsuported HTTP status code ', $statusCode    
            )); 
        }
        
        $this->statusCode = $statusCode;
        return $this;
    }

    public function render(){
        header($this->compileStatusResponse());
        $this->renderHeaders();
        return $this->body; 
    }

    protected function renderHeaders(){
         foreach ($this->headers as $key => $headerValue) {
            header($key . ': ' . $headerValue);
         }
    }

    public function redirect($url, $statusCode = 301){
        $this->addHeader('Location', $url);
        $this->setStatus($statusCode);
        $this->render();
    }

    public function disableBrowserCache() {
        $this->headers[] = 'Cache-Control: no-cache, no-store, must-revalidate'; 
        $this->headers[] = 'Pragma: no-cache'; 
        $this->headers[] = 'Expires: Thu, 26 Feb 1970 20:00:00 GMT'; 
        return $this;
    }

    private function compileStatusResponse(){
        return $this->protocol .' '. $this->statusCode .' '. $this->statusText; 
    }
} 