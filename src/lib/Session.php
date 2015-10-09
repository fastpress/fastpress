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
 * A Session Class
 *
 * @category    Fastpress
 * @package     Session
 * @version     0.1.0
 */
class Session{

    public function __construct(array $conf){
        if(empty($conf)){
            throw new \InvalidArgumentException(
                'Session class requires at least one runtime configuration option'
            );
        }

        if(!session_id()){
            if (session_start()) {
                foreach ($conf as $key => $value) {
                   // 
                }
            }
        }
    }

    public function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public function get($key){
        if(array_key_exists($key, $_SESSION)){
            return $_SESSION[$key]; 
        }

        return FALSE;
    }

    public function delete($key){
        unset($_SESSION[$key]);
    }

    public function regenerate(){
        session_regenerate_id(TRUE);
        return session_id();
    }

    public function destroy(){
    	session_destroy(); 
    }
}

