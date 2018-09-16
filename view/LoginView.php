<?php


// self pekar på classen och används tillsammans med statiska konstanter, this pekar på objekt.
// :: dubbelkolon används enbart med statiska egenskaper(fält,medlemmar). kodkonvention.
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
		if(isset($_POST[self::$signup])){
			$response = $this->registrationView($message);

		} else {
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
	
	public function registrationForm() {
		return isset($_POST[self::$submitSignup]);
	}

	public function loginForm() {
		return isset($_POST[self::$login]);
	}

	 //CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestUserName() {
		if(isset($_POST[self::$name])) {
			return $_POST[self::$name];

		}
		//RETURN REQUEST VARIABLE: USERNAME
	}

	public function getRequestPassword() {
			return $_POST[self::$password];
		//RETURN REQUEST VARIABLE: PASSWORD
	}

	function registrationView($message) {
        
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
