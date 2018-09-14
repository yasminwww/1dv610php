<?php
//
include_once('init.php');


// $db = mysqli_connect("localhost", "root", "", "users");


//

if(isset($_POST['submit'])) {

    session_start();
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $password2 = mysql_real_escape_string($_POST['password2']);


    if($username && $password) {
        if($password == $password2) {

            //test hashing password
            $password = md5($password);
             // Save to db
             $query = "INSERT INTO users(username, password) VALUES ('$username', '$password')";
 
             $result = $database->query($query);

            $_SESSION['message'] = "Success!";
            $_SESSION['username'] = $username;
            header("location: main.php");
 
        } else {
            $_SESSION['message'] = "Password did not match";
        }


    } else {
        echo 'No blank fields!';
    }
}


?>

<form action="view.php" method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="password" name="password2">

    <input type="submit" value="submit" name="submit">
    </form>

</body>
</html>