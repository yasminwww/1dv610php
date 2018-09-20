<?php

// require_once('view/LoginView.php');

//     class RegisterView {

//         private static $name = 'RegisterView::UserName';
//         private static $password = 'RegisterView::Password';
//         private static $keep = 'RegisterView::KeepMeLoggedIn';
//         private static $messageId = 'RegisterView::Message';
        
//         private static $submitSignup = "RegisterView::SubmitSignup";
//         private static $signupForm = "RegisterView::Signup";
//         private static $password2 = "RegisterView::PasswordRepeat";
        
        
        
        
//         public function registrationView($message) {
            
//             return '
//                     <form method="POST">
//                         <input type="submit" name="' . self::$loginForm . '" value="Back to login"/>
//                         <fieldset>
//                             <legend>Sign Up - enter Username and password</legend>
//                             <p id="' . self::$messageId . '">' . $message . '</p>
                            
//                             <label for="' . self::$name . '">Username :</label>
//                             <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestUserName() . '" />
//                             <label for="' . self::$password . '">Password :</label>
//                             <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
//                             <label for="' . self::$password2 . '">Repeat Password :</label>
//                             <input type="password" id="' . self::$password2 . '" name="' . self::$password2 . '" />
//                             <input type="submit" name="' . self::$submitSignup . '" value="SignUp" />
//                         </fieldset>
//                     </form>';
//         }

// }
