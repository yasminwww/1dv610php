
<?php


class AuthController {

//     // Här kan relaterade vyer instansieras och köras efter logik

    private $view;
    private $database;
    private $layoutView;
    private $time;


    public $message;


     public function __construct($v, $database, $lv, $dtv) {
         $this->view = $v;
         $this->database = $database;
         $this->layoutView = $lv;
         $this->time = $dtv;
        //  var_dump($renderAllViews);
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
            // Database has the user
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
