<?php


class Credentials {
	public $username;
	public $password;

	public function __construct(string $username, string $password) {
		$this->username = $username;
		$this->password = $password;
	}
}

class LoginView {

	private static $signupForm = "register";
    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';
	
	private static $cookieName = "LoginView::CookieName";
	private static $cookiePassword = "LoginView::CookiePassword";


	public $correctCredentials;


	public function __construct() {

		$this->correctCredentials = new Credentials('Admin', 'Password');

   }


	public function response() {
		
		//START:

		if ($this->isLoggingOut()) {

			return  $this->generateLoginFormHTML('Bye bye!');

		}

		if ($this->isTryingToSignup()) {

			 if($this->validationMessageRegister() == 'Registered new user.') {

				return $this->generateLoginFormHTML($this->validationMessageRegister());

			 } else {

				return $this->registrationView($this->validationMessageRegister());

			}

	   }
		
		if ($this->isNavigatingToRegistration()) {
			
			return $this->registrationView('');
			
		 }
		 
		if ($this->isTryingToLogin()) {


			if ($this->isAuthorised() && !isset($_SESSION['already-loggedin']))  {

				$_SESSION['already-loggedin'] = true;
				return $this->generateLogoutButtonHTML('Welcome');


			} else if  ($this->isAuthorised() && isset($_SESSION['already-loggedin'])) {

				return $this->generateLogoutButtonHTML('');

			} else {
			
				return  $this->generateLoginFormHTML($this->validationMessageLogin());
			}
			
		} else if ($this->isAuthorised()) {

			return $this->generateLogoutButtonHTML('');

		} else {

			return $this->generateLoginFormHTML('');
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
		<a href="?' . self::$signupForm . '">Register a new user</a>
		<form method="post">
		<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestUserName() . '" />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					<input type="submit" name="' . self::$login . '" value="Login" />
				</fieldset>
            </form>
		';
    }

	public function isNavigatingToRegistration() : 	bool { return isset($_GET[self::$signupForm]); }


	public function isNavigatingToLogin() : bool { return isset($_GET[self::$loginForm]); }


	public function isTryingToSignup() : bool { return isset($_POST[self::$submitSignup]); }

	public function isTryingToLogin()  : bool { return isset($_POST[self::$login]); }

	public function isLoggingOut() : bool { return isset($_POST[self::$logout]) && $this->isAuthorised(); }

	public function getRequestUserName() { 
		if (isset($_POST[self::$name])) {
			return $_POST[self::$name]; 
		}
	}

	public function getRequestPassword() {
		if (isset($_POST[self::$password])) {
			return $_POST[self::$password]; 
		}		
	}

	public function errorMessage($validationMessage) {
		$this->message = $validationMessage;
	}

	
	public function isAuthorised(): bool {
		$correct = $this->correctCredentials;
        return isset($_SESSION['username']) && $_SESSION['username'] == $correct->username &&
               isset($_SESSION['password']) && $_SESSION['password'] == $correct->password;
    }


	public function validationMessageLogin() : string {

		if (empty($this->getRequestUserName())) {

			return 'Username is missing';

		} else if (empty($this->getRequestPassword())) {

			return 'Password is missing';

		} else if ($this->getRequestUserName() != $this->correctCredentials->username ||
				   $this->getRequestPassword() != $this->correctCredentials->password) {
 
 			return 'Wrong name or password';
		
		} else {
			
			return '';
		}
	}

    public function killSession() {
       	return session_destroy();
	}
	
	public function getCredentialsInForm() {
		return new Credentials($this->getRequestUserName(), $this->getRequestPassword());
	}


////////////////////////////////// - Registration View - //////////////////////////////////////////////
/////

	
	private static $registerName = 'RegisterView::UserName';
	private static $registerPassword = 'RegisterView::Password';

	private static $submitSignup = 'RegisterView::Register';
	private static $passwordRepeat = "RegisterView::PasswordRepeat";
	private static $loginForm = "login";
	private static $registerMessageId = 'RegisterView::Message';

	public function registrationView($message) {
        
		return '
		<a href="?' . self::$loginForm . '">Back to login</a>
				<form method="POST">
					<fieldset>
						<legend>Sign Up - enter Username and password</legend>
						<p id="' . self::$registerMessageId . '">' . $message . '</p>
						
						<label for="' . self::$registerName . '">Username :</label>
						<input type="text" id="' . self::$registerName . '" name="' . self::$registerName . '" value="' . strip_tags($this->getRequestUserNameFromRegistration()) . '" />
						<label for="' . self::$registerPassword . '">Password :</label>
						<input type="password" id="' . self::$registerPassword . '" name="' . self::$registerPassword . '" />
						<label for="' . self::$passwordRepeat . '">Repeat Password :</label>
						<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
						<input type="submit" name="' . self::$submitSignup . '" value="SignUp" />
					</fieldset>
                </form>';
	}
	

	public function getRequestUserNameFromRegistration() { 

		if (isset($_POST[self::$registerName])) {
			return $_POST[self::$registerName]; 
		}
	}

	public function getRequestPasswordFromRegistration() {
		if (isset($_POST[self::$registerPassword])) {
			return $_POST[self::$registerPassword]; 
		}		
	}


	public function isUsernameTooShort() : bool {
		return strlen($this->getRequestUserNameFromRegistration()) < 3;
	}

	public function isPasswordTooShort() : bool {
		return strlen($this->getRequestPasswordFromRegistration()) < 6;
	}


	public function validationMessageRegister() : string {
		if (!ctype_alnum($this->getRequestUserNameFromRegistration()) && !empty($this->getRequestUserNameFromRegistration())) {
			return 'Username contains invalid characters.';
		 }

		if ($this->isUsernameTooShort() && $this->isPasswordTooShort()) {
			return 'Username has too few characters, at least 3 characters. Password has too few characters, at least 6 characters.';
		}

		if ($this->isUsernameTooShort()) {
			return 'Username has too few characters, at least 3 characters.';
		}
		
		if ($this->isPasswordTooShort()) {
			return ' Password has too few characters, at least 6 characters.';
		}

			else if($this->getRequestPasswordFromRegistration() != $_POST[self::$passwordRepeat]) {

				return 'Passwords do not match.';

			} else if($this->getRequestUserNameFromRegistration() == $this->correctCredentials->username) {

				return 'User exists, pick another username.';

		} else {
	
			return 'Registered new user.';
		}
	}



	public function getCredentialsInRegisterForm() {
		return new Credentials($this->getRequestUserNameFromRegistration(), $this->getRequestPasswordFromRegistration());
	}

}