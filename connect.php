<?php
$servername = "localhost";
$username = "student";
$password= "website";
$dbasename = "labwork";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbasename);

// Check connection
if ($mysqli->connect_errno) 
{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>
