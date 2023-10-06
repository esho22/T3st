<?php
function ch($value)
{
$value = trim($value);
$value = stripslashes($value);
$value = htmlspecialchars($value);
}
?>