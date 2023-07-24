<?php

//Db details
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'quiz_app';

//Creating a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>