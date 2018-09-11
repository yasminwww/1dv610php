This file is created for testing and learning php.

<?php

if(isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    echo $username;
    echo $password;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="myOwnForm.php" method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="button" value="submit" name="submit">
    </form>
</body>
</html>