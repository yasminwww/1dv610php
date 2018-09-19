
<?php


class AuthController {

//     // Här kan relaterade vyer instansieras och köras efter logik

    private $view;
    private $database;
    public $message;

     public function __construct($v, $database) {
         $this->view = $v;
         $this->database = $database;
        //  var_dump($database);
     }


    // OM SIGNUP KNAPPEN HAR BLIVIT TRYCKT
    public function register() {

        if($this->view->checkRegistrationForm()) {

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
// Kolla om funtionerna är 
    public function login() {

        if($this->view->checkLoginForm()) {
            $username = $this->view->getRequestUserName();
            $password = $this->view->getRequestPassword();
            if($username == 'Admin' && $password == 'Admin') {
                // echo $username;
                $_SESSION['user'] = $username;
                echo $_SESSION['user'];
            } else {
               return $this->view->errorMessage();
            }
        }
    } 
}
