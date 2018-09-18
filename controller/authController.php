<?php


class AuthController {

//     // Här kan relaterade vyer instansieras och köras efter logik

    private $view;
    private $database;

     public function __construct($v, $database) {
         $this->view = $v;
         $this->database = $database;
        //  var_dump($database);
     }


    // OM SIGNUP KNAPPEN HAR BLIVIT TRYCKT
    public function register() {

        if($this->view->registrationForm()) {

            $username = $this->view->getRequestUserName();
            $password = $this->view->getRequestPassword();
    
            // IF validation from  model-database is true,!!
                $user = new User();
                $user->setUsername($username);
                $user->setPassword($password);
                $user->saveUser($this->database);
                $person = $user->getUsername();

                return $this->view->monkey();

        }
    }

    public function login() {

        if($this->view->loginForm()) {
            $username = $this->view->getRequestUserName();
            $password = $this->view->getRequestPassword();
            if($username == 'Admin' && $password == 'Admin') {
                echo $username;
                $_SESSION['user'] = $username;
            }
            
        }
    } 
}
