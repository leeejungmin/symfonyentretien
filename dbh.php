<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:Origin, Content-Type, Authorization, X-Auth-Token');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS');

$dbServername ="localhost";
$dbUsername ="root";
$dbPassword ="111111";
$dbname ="inscription";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbname);

 ?>
