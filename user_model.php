<?php


class User {
    
    // Undgå error vid start.
    private $username = null;
    private $password = null;

    public function setUsername($username, $password) {

        $this->username = $username;
        $this->password = $username;
    }
    
    public function setPassword($password) {

        $this->password = $password;
    }

    public function getUsername() {

        return $this->username;
}

}