<?php

class Admins extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->adminModel = $this->model('Admin');
        $this->userModel = $this->model('User');
    }

    public function index(){
        // Get users
        $users = $this->adminModel->getUsers();
  
        $data = [
          'users' => $users
        ];
  
        $this->view('admins/index', $data);
      }
  
      public function add(){
      // Check for User
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $user = $this->adminModel->getUserById($id);

        // Init data
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        } else {
          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->adminModel->addUser($data)){
            flash('user_created_success', 'User has been created');
            redirect('admins/index');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('admins/add', $data);
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('admins/add', $data);
      }
    }
  
      public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Sanitize POST array
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $user = $this->adminModel->getUserById($id);

          $data = [
            'id' => $id,
            'name' => $user->name,
            'user_type' => trim($_POST['user_type']),
            'user_type_err' => ''
          ];
  
          // Validate data
          if(empty($data['user_type'])){
            $data['user_type_err'] = 'Please enter user role';
          }
          
          $role = array("Developer", "Client");

          if(in_array($data['user_type'], $role)){
              //All is well
          } else{
            $data['user_type_err'] = 'Please enter either Developer or Client as a role';
          }
  
          // Make sure no errors
          if(empty($data['user_type_err']) ){
            // Validated
            if($this->adminModel->updateUser($data)){
              flash('admin_message', 'User Role Updated');
              redirect('admins/index');
            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('admins/edit', $data);
          }
  
        } else {
          // Get existing user from model
          $user = $this->adminModel->getUserById($id);

          // Check for owner
          if($_SESSION['user_type'] != 'admin'){
            redirect('posts/index');
          }
  
          $data = [
            'id' => $id,
            'name' => $user->name,
            'user_type' => $user->user_type
          ];
    
          $this->view('admins/edit', $data);
        }
      }
  
      public function show($id){
        $user = $this->adminModel->getUserById($id);
  
        $data = [
          'user' => $user
        ];
  
        $this->view('admins/show', $data);
      }
  
      public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing user from model
          $user = $this->adminModel->getUserById($id);
          
          // Check for owner
          if($_SESSION['user_type'] != 'admin'){
            redirect('posts/index');
          }
  
          if($this->adminModel->deleteUser($id)){
            flash('admin_message', 'User Removed');
            redirect('admins/index');
          } else {
            die('Something went wrong');
          }
        } else {
          redirect('admins/show');
        }
      }

}





?>