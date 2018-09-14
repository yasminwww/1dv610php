<?php

class RegisterView {
 
    function registrationView() {
        if(isset($_POST['signUp'])) {
        
        return '
            <h2>SignUp</h2>
                <form method="POST">
                    <input type="text" name="username">
                    <input type="password" name="password">
                    <input type="password" name="password2">
                    <input type="submit" value="SignUp" name="submit">
                </form>';
        }
    }
}