<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    body {font-family: Arial, Helvetica, sans-serif;}
    form {border: 3px solid #f1f1f1;}

    input[type=text], input[type=password]{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    }

    button {
    background-color: #1bde89;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    }
    </style>
</head>
<body>
<form method="post">
        <label>Username</label>
            <input type="text" name="uname" placeholder="Username">
        <label>Password</label>
            <input type="password" name="pass" placeholder="Password">
            <?php echo $_GET['err'];?>
        <button type="submit">Sign in</button>
    </form>
</body>
</html>
<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user = $_POST['uname'];
    $pass = $_POST['pass'];
    if($user == "hesham" && $pass == "123"){
        header('location: home.php');
        $_SESSION['user'] = $user;
    }
    else header('location: login.php?err=invalid data');
}
?>