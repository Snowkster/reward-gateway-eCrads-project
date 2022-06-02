<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "123123";
$dBName = "phpeCardProject";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
    
}