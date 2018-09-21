<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
// require_once('view/RegisterView.php');
require_once('database.php');
require_once('model/user_model.php');

    //MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

session_start();

class MainController {

    private $layoutView;
    private $loginView;
    private $timeView;
    // private $registerView;


    private $database;


    public function __construct() {
        $this->layoutView = new LayoutView();
        $this->loginView = new LoginView();
        $this->timeView = new DateTimeView();
        // $this->registerView = new RegisterView();

        // $this->database = new Database();
    }

    public function run() {
        // if($this->loginView->isNavigatingToRegistration()) {

            // var_dump($_GET);
            if ($this->loginView->isTryingToSignup()) {
                $credentials = $this->loginView->getCredentialsInRegisterForm();
                // debug_print_backtrace();
                if($credentials->username >=3 && $credentials->password >=6) {
                    $_SESSION['username'] = $credentials->username;
                    $_SESSION['password'] = $credentials->password;
                    echo $_SESSION['username'];
                }
        // }



        } else if ($this->loginView->isTryingToLogin()) {

            $credentials = $this->loginView->getCredentialsInForm();

            if ($credentials->username == $this->loginView->correctCredentials->username &&
                $credentials->password == $this->loginView->correctCredentials->password) {
                $_SESSION['username'] = $credentials->username;
                $_SESSION['password'] = $credentials->password;
                // echo $_SESSION['username'];
            //   if ($this->loginView->isLoggingOut()) {
            //         echo 'logoutbutton';
            //     return $this->loginView->generateLogoutButtonHTML('Bye bye!');

            // }
            
        } 
    }
    if ($this->loginView->isLoggingOut()) {
        $this->killSession();
        return $this->layoutView->render(false, $this->loginView, $this->timeView);        

    } else {

        $this->renderHTML();
    }
}

    private function renderHTML() {
        $this->layoutView->render($this->loginView->isAuthorised(), $this->loginView, $this->timeView);
    }

    public function killSession() {
        session_destroy();
    }
}


$controller = new MainController();

$controller->run(); //renderHTML();

