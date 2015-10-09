<?php
/**
 * FASTPRESS  | A fast PHP microframework
 *
 * @author      Sim. Daniel <samayo@gmail.com>
 * @link        https://github.com/fastpress
 * @copyright   Copyright (c) 2013 SD
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */
namespace Fastpress;

/**
 * A Template Class
 *
 * @category    Fastpress
 * @package     Template
 * @version     0.1.0
 */
class Template{
    private $app; 
    private $data; 
    private $view;
    private $block = []; 
    private $layout; 
    private $vars = [];
    private $path = [
        'views'  => '', 
        'layouts' => '',
    ];

    public function __construct(array $conf, $app){
        if(empty($conf)){
            throw new \InvalidArgumentException(
                'template class requires atleast one runtime options'
            );
        }
        
        $this->app = $app;
        $this->path['views']   = $conf['views']; 
        $this->path['layouts'] = $conf['layout']; 
    }

    public function view($view, array $vars = []){
        $this->vars = $vars; 
        $app = $this->app;
        if($this->view === null){
            extract($this->vars, EXTR_SKIP);
            $this->view =  $this->path['views'] . $view . '.php';      
            require $this->view; 
        }
        return $this;
    }

    public function extend($layout){
        $this->layout = $this->path['layouts'] . $layout . '.html'; 
        return $this; 
    }

    public function render(){
           $app = $this->app;
    }

    public function content($name){
        if(array_key_exists($name, $this->block)){
            return $this->data; 
        }
    }

    public function layout($layout, array $vars = []){
        extract($vars, EXTR_SKIP);
        require $this->path['layouts'] . $layout . '.html';
    }

    public function block($name){
        $this->block[$name] = $name; 
        ob_start();
    }

    public function endblock($name){
        if(!array_key_exists($name, $this->block)){
            throw new \Exception; 
        }
        
        $app = $this->app;
        $this->data = ob_get_contents();
        ob_end_clean();      
        require $this->layout;
    }

}

   