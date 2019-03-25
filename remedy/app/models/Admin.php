<?php

  class Admin {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
    
    public function getUsers(){
        $this->db->query('SELECT * FROM users WHERE id != :userId ORDER BY created_at DESC');
        $this->db->bind(':userId', $_SESSION['user_id']);

      $results = $this->db->resultSet();

      return $results;
    }

    //Create a user
    public function addUser($data){
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }

    public function updateUser($data){
      $this->db->query('UPDATE users SET user_type = :userType WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':userType', $data['user_type']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getUserById($id){
      $this->db->query('SELECT * FROM users WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteUser($id){
      $this->db->query('DELETE FROM users WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }