<?php
//



$db = mysqli_connect("localhost", "root", "", "users");


//

if(isset($_POST['submit'])) {

    session_start();
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $password2 = mysql_real_escape_string($_POST['password']);


    if($username && $password) {
        if($password == $password2) {

            echo $username;
            echo $password;
            //test hashing password
            $password = md5($password);
        }


    } else {
        echo 'No blank fields!';
    }

}


?>

<form action="register.php" method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit" value="submit" name="submit">
    </form>

</body>
</html>