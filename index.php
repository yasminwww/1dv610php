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

            $username = $this->loginView->getRequestUserName();
            $password = $this->loginView->getRequestUserName();

            // echo 'isTryingToRegister';
            // $user = new User($username, $password);
            // $user->saveUser($this->database);
            // $person = $user->getUsername();

        } else if ($this->loginView->isTryingToLogin()) {
            return $this->loginView->validationMessage();

            // echo 'isTryingToLogin';

        } else {
            // echo 'Your attempts are futile  and laughable and smell of catshit';
        }

        // Render site accordingly
        $this->renderHTML();
    }

    //private function isLoggingIn(): bool {}

    //private function isSigningUp(): bool {}

    private function renderHTML() {
        $this->layoutView->render($this->loginView->isAuthorised(), $this->loginView, $this->timeView);
    }
}


$controller = new MainController();

$controller->run(); //renderHTML();