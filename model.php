<?php


class User {
    
    // Undgå error vid start.
    private $username = null;
    private $password = null;

//     public function __contruct($username, $passsword) {
//         $this->username = $username;
//         $this->password = $password;

// }
    public function setUsername($username) {

        $this->username = $username;
    }
    
    public function setPassword($password) {

        $this->password = $password;
    }

    public function getUsername() {

        return $this->username;
}

 
}