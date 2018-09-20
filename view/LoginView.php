<?php

// require_once('RegisterView.php');

class Credentials {
	public $username;
	public $password;

	public function __construct(string $username, string $password) {
		$this->username = $username;
		$this->password = $password;
	}

	// public function matches($another): bool {
	// 	return $this->username == $another->username && $this->password == $another->password;
	// }
}

class LoginView {

    
    private static $submitSignup = "LoginView::SubmitSignup";
    private static $signupForm = "LoginView::Signup";
    private static $passwordRepeat = "LoginView::PasswordRepeat";

	private static $loginForm = "LoginView::LoginForm";
    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';
	
	private static $cookieName = "LoginView::CookieName";
	private static $cookiePassword = "LoginView::CookiePassword";

	// TODO NOT HERE DUMKOMPF EVIL WOMAN
	public $correctCredentials;

	private $message = '';
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */

	public function __construct() {
		$this->correctCredentials = new Credentials('Admin', 'password');

	}
	
	public function response() {
		
		//START:

		if ($this->isNavigatingToRegistration()) {

			
			// echo '1';
			return $this->registrationView('');
			
 		} else if ($this->isTryingToSignup()) {
			 
			//  echo '2';
			return $this->registrationView($this->validationMessageRegister());

		} else if ($this->isTryingToLogin()) {

			if($this->isAuthorised()) {

				return $this->generateLogoutButtonHTML('Welcome!');

			} else {

				// echo '3';
				return  $this->generateLoginFormHTML($this->validationMessageLogin());
			}
			
		} else {
			session_destroy();			
			// echo '4';
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
		<form method="post">
		<input type="submit" name="' . self::$signupForm . '" value="Register a new user"/>
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

	public function isNavigatingToRegistration() : 	bool { return isset($_POST[self::$signupForm]); }
	public function isNavigatingToLogin() : 	bool { return isset($_POST[self::$loginForm]); }


	public function isTryingToSignup() : bool { return isset($_POST[self::$submitSignup]); }
	public function isTryingToLogin() 	 : 	bool { return isset($_POST[self::$login]); }

	public function isLoggingOut() : bool { return isset($_POST[self::$logout]); }

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

		if(empty($this->getRequestUserName())) {

			return 'Username is missing';

		} else if(empty($this->getRequestPassword())) {

			return 'Password is missing';

		} else if ($this->getRequestUserName() != $this->correctCredentials->username ||
		           $this->getRequestPassword() != $this->correctCredentials->password) {
			
			return 'Wrong name or password';
		
		} else {
			
			return '';
		}
	}


	// private static $name = 'RegisterView::UserName';
    // private static $password = 'RegisterView::Password';
    
    // private static $submitSignup = "RegisterView::SubmitSignup";
    // private static $signupForm = "RegisterView::Signup";
    // private static $passwordRepeat = "RegisterView::PasswordRepeat";
    
    
    
    
    
    public function registrationView($message) {
        
        return '
                <form method="POST">
                    <input type="submit" name="' . self::$loginForm . '" value="Back to login"/>
                    <fieldset>
                        <legend>Sign Up - enter Username and password</legend>
                        <p id="' . self::$messageId . '">' . $message . '</p>
                        
                        <label for="' . self::$name . '">Username :</label>
                        <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestUserName() . '" />
                        <label for="' . self::$password . '">Password :</label>
                        <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
                        <label for="' . self::$passwordRepeat . '">Repeat Password :</label>
                        <input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
                        <input type="submit" name="' . self::$submitSignup . '" value="SignUp" />
                    </fieldset>
                </form>';
    }

	
	public function isUsernameTooShort() : bool {
		return strlen($this->getRequestUserName()) < 3;
	}

	public function isPasswordTooShort() : bool {
		return strlen($this->getRequestPassword()) < 6;
	}

	public function validationMessageRegister() : string {

			if ($this->isUsernameTooShort() && isPasswordTooShort()) {
				return 'Username has too few characters, at least 3 characters. Password has too few characters, at least 6 characters.';
			}

			if ($this->isUsernameTooShort()) {
				return 'Username has too few characters, at least 3 characters.';
			}
			
			if ($this->isPasswordTooShort()) {
				return ' Password has too few characters, at least 6 characters.';
			}

			else if($this->getRequestPassword() != $_POST[self::$passwordRepeat]) {

				return 'Password does not match';

		} else if($this->getRequestUserName() == $this->correctCredentials->username) {

			return 'User exists, pick another username.';

		} else {
		
			return 'Registered new user.';
		}
	}

	public function userHasValidRegistrationInformation()
 {
	
 }
	public function getCredentialsInForm() {
		return new Credentials($this->getRequestUserName(), $this->getRequestPassword());
	}
}
