<?php

class LoginView {


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
		if(isset($_POST['SignupButton'])){
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
				<p id="Message">' . $message .'</p>
				<input type="submit" name="Logout" value="logout"/>
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
		<input type="submit" value="SignUp" name="SignupButton">

				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="Message">' . $message . '</p>
					
					<label for="UserName">Username :</label>
					<input type="text" id="UserName" name="UserName" value="" />

					<label for="Password">Password :</label>
					<input type="password" id="Password" name="Password" />

					<label for="KeepMe">Keep me logged in  :</label>
					<input type="checkbox" id="KeepMe" name="KeepMe" />
					
					<input type="submit" name="Login" value="Login" />
				</fieldset>
			</form>
		';
	}
	
	public function registrationForm() {
		return isset($_POST['SubmitSignup']);
	}

	public function loginForm() {
		return isset($_POST['Login']);
	}

	 //CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestUserName() {
		if(isset($_POST['UserName'])) {
			return $_POST['UserName'];

		}
		//RETURN REQUEST VARIABLE: USERNAME
	}

	public function getRequestPassword() {
			return $_POST['Password'];
		//RETURN REQUEST VARIABLE: PASSWORD
	}

	function registrationView($message) {
        
        return '
				<form method="POST">
					<fieldset>
						<legend>Sign Up - enter Username and password</legend>
						<p id="Message">' . $message . '</p>
						
						<label for="UserName">Username :</label>
						<input type="text" id="UserName" name="UserName" value="" />

						<label for="Password">Password :</label>
						<input type="password" id="Password" name="Password" />

						<label for="Password2">Repeat Password :</label>
						<input type="password" id="Password2" name="Password2" />

						<input type="submit" name="SubmitSignup" value="Signup" />
					</fieldset>
                </form>';
	}
	
	public function monkey() {
		return '<h1>MONKEY!</h1>';
	}
}
