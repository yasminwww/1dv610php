<?php
require_once('init.php');

// $query = "SELECT * FROM users WHERE id=2 ";

    // $result = $database->query($query);
    // $user_found = mysqli_fetch_array($result);

    // echo $user_found['username'];
  
// }

class User {
    
    // Undgå error vid start.
    private $username = null;
    private $password = null;

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

			$result = $database->guery($guery);

	}
		// $password = $_POST[self::$password];

		// if($username && $password) {
		// 	echo ' Welcome ' . $username; 
		// }else {
		// 	echo 'You left blank fiels(s).';
		// }
		// $query = "SELECT * FROM users WHERE id=1 ";
		// $query .= "VALUES ('$username', '$password')";

		// $result = $database->query($query);
	
		// if(!$result) {
		// 	die('query failed');
		// } else {
		// 	echo 'query success';
		// }
}