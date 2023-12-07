<?php
$servername = "localhost";
$username = "adcglob1_boyem";
$password = "186982JUNj!";
$dbname = "adcglob1_boyem";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$url__= "https://adcglobal.site/testtest/test/";
?>
