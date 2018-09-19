<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('database.php');
require_once('model/user_model.php');


$DEPLOYED = false;

if ($DEPLOYED) {

} else {
    //MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

session_start();

class MainController {

    private $layoutView;
    private $loginView;
    private $timeView;

    private $database;


    public function __construct() {
        $this->layoutView = new LayoutView();
        $this->loginView = new LoginView();
        $this->timeView = new DateTimeView();

        // $this->database = new Database();
    }

    public function run() {

        if ($this->loginView->isTryingToSignup()) {
            debug_print_backtrace();
            $credentials = $this->loginView->getCredentialsInForm();


        } else if ($this->loginView->isTryingToLogin()) {

            $credentials = $this->loginView->getCredentialsInForm();

            if($credentials->username == 'Admin' && $credentials->password == 'Admin') {
                $_SESSION['username'] = $credentials->username;
                $_SESSION['password'] = $credentials->password;
                echo $_SESSION['username'];

            } else {
                // TODO Currently, this code does nothing at all. DIsplay the message somehow.
                //$this->loginView->validationMessage();
            }

            // echo 'isTryingToLogin';

        } else {
            // echo 'Your attempts are futile  and laughable and smell of catshit';
        }

        // Render site accordingly
        $this->renderHTML();
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