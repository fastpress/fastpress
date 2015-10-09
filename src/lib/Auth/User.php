<?php


namespace Fastpress\Auth;
use Fastpress\Session; 

class User
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function isLoggedIn()
    {
        return false != $this->session->get('user');
    }

    public function getUser(){
        return $this->session->get('user');
    }

    public function isAdmin()
    {
        if($user = $this->getUser()){
            if($user['is_admin']){
                return true; 
            }
        }

        return false; 
    }

    public function login(array $userData)
    {
        if (array_key_exists('id', $userData)) {
            $this->session->set('user', $userData);
            return true;
        }

        return false;
    }
  
    public function logout()
    {
        $this->session->destroy();
    }
}
