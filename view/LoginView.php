<?php
class LoginView {
	private static $submitSignup = "LoginView::SubmitSignup";
	private static $signup = "LoginView::Signup";
	private static $password2 = "LoginView::Password2";

    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';
	
	private static $cookieName = "LoginView::CookieName";
	private static $cookiePassword = "LoginView::CookiePassword";


	private $message = '';
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	
	public function response() {
		$message = $this->message;
		//START: Lägger till en regView
		if ($this->isNavigatingToRegistration()) {
			// echo '1';
			return $this->registrationView($message);

		} else if ($this->isTryingToLogin($message)) {
			// echo '2';
		} else {
			// echo '3';
			return $this->generateLoginFormHTML($message);
			//return $this->generateLogoutButtonHTML($message);
		}
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	public function generateLogoutButtonHTML($message) {
		return '
		<form method="post">
			<p id="' . self::$messageId . '">' . $message . '</p>
			<input type="submit" name="' . self::$logout . '" value="logout" />
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
		<form method="post">
		<input type="submit" value="SignUp" name="' . self::$signup . '">
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

	public function isNavigatingToRegistration() : 	bool { return isset($_POST[self::$signup]); }

	public function isTryingToSignup() : bool { return isset($_POST[self::$submitSignup]); }
	public function isTryingToLogin() 	 : 	bool { return isset($_POST[self::$login]); }

	public function getRequestUserName() { return $_POST[self::$name]; }

	public function getRequestPassword() { return $_POST[self::$password]; }

	public function errorMessage($validationMessage) {
		$this->message = $validationMessage;
	}

	
    public function isAuthorised(): bool {
        return isset($_SESSION['username']) && $_SESSION['username'] == 'Admin' &&
               isset($_SESSION['password']) && $_SESSION['password'] == 'Admin';
    }

	public function validationMessage(): string {
		if(empty($this->getRequestUserName())) {
			return 'Username is missing';
		} else if(empty($this->getRequestPassword())) {
			return 'Password is missing';
		}
	}
	// public function errorMessage() {
	// 	if(empty($_POST[self::$name])) {
	// 	self::$message = 'Username is missing.';
	// 	return self::$message;
	// 	} else if(empty($_POST[self::$password])) {
	// 		self::$message = 'Password is missing.';
	// 	return self::$message;
	// 	}
	// 	if(isset($_POST[self::$name])) {
	// 		self::$message = 'got to hell';
	// 	}
	// }
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