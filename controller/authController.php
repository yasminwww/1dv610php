<?php

class authController {

//     // Här kan relaterade vyer instansieras och köras efter logik

function register() {

    
    // if() {
        $reg = new RegisterView();
        return $this->reg->registrationView();

        // IF validation from  model-database is true,!!

            $user = new User();
            $user->name = $l->getRequestUserName();
            $user->password = $l->getRequestPasswrd();

    // }
}

}