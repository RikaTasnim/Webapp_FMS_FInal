<?php

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "fms";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>