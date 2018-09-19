<?php

class LoginView {

	private static $login = 'LoginView::Login';
	private static $submitSignup = 'LoginView::SubmitSignup';
	private static $signup = 'LoginView::Signup';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $password2 = 'LoginView::Password2';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	public $message = '';

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	
	public function response() {
		
		//START: Lägger till en regView
		if(isset($_POST[self::$signup])){
			$response = $this->registrationView($this->errorMessage());
		 } 


			$response = $this->generateLoginFormHTML($this->errorMessage());
			//$response .= $this->generateLogoutButtonHTML($message);
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	public function generateLogoutButtonHTML($message) {
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
	public function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
			<input type="submit" value="SignUp" name="LoginView::Signup">
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="Login" />
				</fieldset>
			</form>
		';
	}

	public function checkRegistrationForm() {
		return isset($_POST[self::$submitSignup]);
	}

	public function checkLoginForm() {
		return isset($_POST[self::$login]);
	}

	public function getRequestUserName() {
		if(isset($_POST[self::$name])) {
		return $_POST[self::$name];
		}
	}
	public function getRequestPassword() {
		if(isset($_POST[self::$password])) {
			return $_POST[self::$password];
		}
	}

	public function errorMessage() {
		if(empty($_POST[self::$name])) {
			return 'Username is missing.';

		} else if(empty($_POST[self::$password])) {
			return 'Password is missing.';


		}else if()
		// if(isset($_POST[self::$name]) {
		// 	$this->$message = 'got to hell';
		// }
	}

	public function registrationView($message) {
        
        return '
				<form method="POST">
					<fieldset>
						<legend>Sign Up - enter Username and password</legend>
						<p id="' . self::$messageId . '">' . $message . '</p>
						
						<label for="' . self::$name . '">Username :</label>
						<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />
						<label for="' . self::$password . '">Password :</label>
						<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
						<label for="' . self::$password2 . '">Repeat Password :</label>
						<input type="password" id="' . self::$password2 . '" name="' . self::$password2 . '" />
						<input type="submit" name="' . self::$submitSignup . '" value="Signup" />
					</fieldset>
                </form>';
	}
	
	public function monkey() {
		return '<h1>MONKEY!</h1>';
	}
}
