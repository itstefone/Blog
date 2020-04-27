<?php
namespace App\Contracts;



  interface UserContract
  {
      public function listUsers($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc');
      public function findUserById(int $id);
  
    
      public function createUser(array $params);
  
      
      public function updateUser(array $params);
  

      public function deleteUser($id);


      public function login(array $attributes);


      public function refresh(array $attributes);

      public function logout();

}