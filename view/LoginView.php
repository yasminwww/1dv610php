<?php

// require_once('database.php');
// require_once('init.php');

// LoginView->$login;

// self pekar på classen och används tillsammans med statiska konstanter, this pekar på objekt.
// :: dubbelkolon används enbart med statiska egenskaper(fält,medlemmar). kodkonvention.
class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';


	

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = '';

		//START: Lägger till en regView
		if(isset($_POST['signup'])){

			$response = $this->registrationView();
		}else {
			$response = $this->generateLoginFormHTML($message);
			//$response .= $this->generateLogoutButtonHTML($message);
			$this->getRequestUserName();
		}
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
		return $_POST[self::$name];


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

	function handelingError() {
		if($_POST[self::$name] && $_POST[self::$password]) {

			//Checka med databasen att allt är ok, och validera tecken
			
			return '<h3>Success</h3>';
		} else {
			return '<h3>Please fill in all fields.</h3>';
		}
	}

	function registrationView() {
        
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