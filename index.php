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

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();


$lv->render(false, $v, $dtv);



//CREATE OBJECTS OF CONTROLLERS
$authC = new authController($v);
echo $authC->register();

//CREATE OBJECTS OF DATABASE
$database = new Database();
$userModel = new User();
$user = $v->getRequestUserName();
// $userModel->saveUser($user);
// echo $user;

 
