<?php

namespace App\Model;

class UserRepository{

 function addUser(array $input){
    $stmt = $this->pdo->prepare(" 
            INSERT INTO users (username, email, password, is_admin) 
            VALUES (?, ?, ?, 0)");
   $result =  $stmt->execute([
        $input['username'], 
        $input['email'],
        $input['password']]);   

   if($result){
    return true; 
   }
 }


 function loginAuth($email, $password){
    $stmt = $this->pdo->prepare("
        SELECT  id, email, password, is_admin 
            FROM users 
            WHERE email = ? 
            LIMIT 1 "
        ); 

    $user = $stmt->execute([$email]); 
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])){
        return [
                'id'       => $user['id'],
                'email'    => $user['email'],
                'is_admin' => $user['is_admin'] 
            ];
    }

    return false;
 }
}


