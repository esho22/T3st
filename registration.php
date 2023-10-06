<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <style>
    body {font-family: Arial, Helvetica, sans-serif;}
    form {border: 3px solid #f1f1f1;}

    input[type=text], input[type=password],input[type=email] {
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
    <form action="" method="post">
        <label>Username</label>
            <input type="text" name="uname" placeholder="Username">
        <label>Password</label>
            <input type="password" name="pass" placeholder="Password">
        <label>Retype Password</label>
            <input type="password" name="rpass" placeholder="Retype Password">
        <label>Email</label>
            <input type="email" name="email" placeholder="Email">
        <label>Phone</label>
            <input type="text" name="phone" placeholder="Phone">
        <button type="submit">Sign up</button>
    </form>
</body>
</html>

<?php
$username=$phone=$pass=$rpass=$email="";
$Errors_username=array(
    'uname_lenght'=>"Username must be less than 12 chars",
    'uname_alpha'=>"Username must be alpha",
    'uname_empty'=>"Username required"
);
$Errors_pass=array(
    'pass_lenght'=>"Password must be more than 20 chars",
    'pass_az09&'=>"Password must be alpha or numbers or sympols",
    'pass_empty'=>"Password required"
);
$Errors_phone=array(
    'phone_lenght'=>"phone number must be 11 numbers",
    'phone_num'=>"phone number must be numbers",
    'phone_empty'=>"phone number required"
);
require('fn.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    global $username,$phone,$pass,$rpass,$email;
    if(isset($_POST['submit'])){
        $username = ch($_POST['uname']);
        $phone = ch($_POST['phone']);
        $email = ch($_POST['email']);
    }
    if(!empty($_POST['uname'])){
        if(ctype_alnum($_POST['uname'])){
            if(strlen($_POST['uname'])<12){
                $username = $_POST['uname'];
            }else echo $Errors_username['uname_lenght'] ;
        }else echo $Errors_username['uname_alpha'] ;
    }else echo $Errors_username['uname_empty'];

    if(!empty($_POST['pass']) && (isset($_POST['rpass']))){
        if(ctype_alnum($_POST['pass'])&& ctype_alnum($_POST['rpass'])){
            if(strlen($_POST['pass'])>8){
                if($_POST['pass'] === $_POST['rpass']){
                    $pass = $_POST['pass'];
                    $rpass = $_POST['rpass']; 
                }
            }else echo $Errors_pass['pass_lenght'] ;
        }else echo $Errors_pass['pass_az09&'] ;
    }else echo $Errors_pass['pass_empty'];

    if(!empty($_POST['phone'])){
        if(ctype_digit($_POST['phone'])){
            if(strlen($_POST['phone'])==11){
                $phone = filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
            }else echo $Errors_phone['phone_lenght'] ;
        }else echo $Errors_phone['phone_num'] ;
    }else echo $Errors_phone['phone_empty'];
    
    if(!empty($_POST['email'])){
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) echo "Invalid Email";
    }else echo "Email Required";

   require 'db.php';
   $pass = md5($pass);
   $query = "INSERT INTO `accounts` (`id`,`phone`,`name`,`password`) VALUES (NULL,'$phone','$username','$pass')";
   $con_query = mysqli_query($connection,$query);
   if($con_query){
   header('location: login.php');
   }
}
?>