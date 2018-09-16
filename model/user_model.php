<?php
// require_once('init.php');


class User extends Database{
    
    // Undgå error vid start.
    private $username;
	private $password;
	private $database;

	// public function __contruct($database) {
	// 	$this->database = new Database();
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
	// public function checkForDublicatedUsernames() {
	// }

	public function saveUser() {
		
			$query = "INSERT INTO users(username, password) VALUES ('$this->username', '$this->password')";

			$result = $this->database->guery($guery);

	}

}