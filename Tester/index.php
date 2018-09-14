<?php

require_once('controller.php');
require_once('model/user_model.php');
require_once('view.php');
require_once('init.php');




$controller = new AppController();
$view = new View();










// @$submit = $_REQUEST['submit'];

// switch($submit) {
//     case 'save': 
//     $username = $_POST['username'];
//     $password = $_POST['password'];
    
//     if($cotroller->login($username, $password)) {
//         echo "thank you " . $username;
//     }
//     break;
// }