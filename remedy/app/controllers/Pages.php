<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      if(isLoggedIn()){
        if($_SESSION['user_type'] == 'admin' ){
          redirect('admins/index');
        } else{
          redirect('posts/index');
        }
      }

      $data = [
        'title' => 'Remedy',
        'description' => 'Simple incident management app built on MVC PHP framework'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to manage incidents'
      ];

      $this->view('pages/about', $data);
    }
  }