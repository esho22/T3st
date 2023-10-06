<?php
session_start();
if(!empty($_SESSION['user']))
echo"hello ".$_SESSION['user'];
else header('location: login.php?err=please login first');
if($_SERVER['REQUEST_METHOD']=="POST")
{
    session_destroy();
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<form method="post">
    <button>logout</button>
</form>
</html>