<?php
// include_once('model/user_model.php');
// include_once('database.php');
// include_once('init.php');


class authController extends LoginView{

//     // Här kan relaterade vyer instansieras och köras efter logik


    // private $user;


    //  public function __contruct(\model\user_model $user) {
    //      $this->user = $user;
    //         $this->view = new LoginView();
    //  }


    // OM SIGNUP KNAPPEN HAR BLIVIT TRYCKT
    public function register() {

        if($this->registrationForm()) {
            // $reg = new RegisterView();
            // return $this->reg->registrationView();
            $username = $this->getRequestUserName();
            $password = $this->getRequestPassword();
            echo $username;
    
            // IF validation from  model-database is true,!!
    
                $user = new User();
                $user->setUsername($username);
                $user->setPassword($password);
                $user->saveUser();

                return $this->monkey();

    }

    }
}
