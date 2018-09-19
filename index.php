<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/authController.php');
require_once('database.php');
require_once('model/user_model.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();


$lv->render(false, $v, $dtv);


$database = new Database();

//CREATE OBJECTS OF CONTROLLERS
$authC = new AuthController($v, $database);
echo $authC->register();
echo $authC->login();

//CREATE OBJECTS OF DATABASE
//$userModel = new User();
//$userModel->saveUser($database);
// $user = $v->getRequestUserName();
// $userModel->saveUser($user);
// echo $user;

 
