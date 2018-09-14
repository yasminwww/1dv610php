<?php


if($database->getConnection()) {
    echo 'true' . '<br>';
}

class AppController {


    // Constructor, kanske skapas automatiskt
    // TODO: Kolla upp det översta.

    function createUser($username, $password) {
        if(!isset($_POST['submit'])) {
            return false;
        } else if($username && $password) {
            // Save to db
            $query = "INSERT INTO users(username, password) ";
            $query .= "VALUES ('$username', '$password')";

            $result = $database->query($query);

                if(!$result) {
                    die('query failed');
                } else {
                    echo 'query success' . $result;
                }
            }

    }


    function loginUser($username, $password) {

        if($this->authenticate($username, $password)) {
            echo "youre in";
            // Start the session
            session_start();
            $user = new User($username);

            // Save session to new user
            $_SESSION['user'] = $user;
            return true;

        } else {
            echo "Not corrent username OR password..";
            return false;
        }
    }

    function authenticate($u, $p) {
        $auth = false;
        // Check in database...if excists..
        if($u == 'admin' && $p == 'admin' ) {
            return true;
        } else {
            return $auth;
        }

    }

    function logout() {
        
        session_start();
        session_destroy();

    }

}