<?php
class AuthController {
//     // Här kan relaterade vyer instansieras och köras efter logik
    private $view;
    private $database;
    public $message;


     public function __construct($v, $database) {
         $this->view = $v;
         $this->database = $database;
     }

    // IF SIGNUP BUTTON HAS BEEN PUSHED
    public function register() {
        if($this->view->checkRegistrationForm()) {
            $username = $this->view->getRequestUserName();
            $password = $this->view->getRequestPassword();
    
            // IF validation from  model-database is true
                $user = new User($username, $password);
                $user->saveUser($this->database);
                $person = $user->getUsername();
                return $this->view->monkey();
        }
    }

    public function login() {
        if($this->view->checkLoginForm()) {

            $username = $this->view->getRequestUserName();
            $password = $this->view->getRequestPassword();
        
            if($username == 'Admin' && $password == 'Admin') {
       
                $_SESSION['username'] = $username;
                echo $_SESSION['username'];
            } 
             else if(empty($username)) {
  
             $this->view->errorMessage('Username is missing.');

            }

            }
        }
    } 
