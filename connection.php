<?php

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "dbmsproject";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die('Could not connect to the database.');
}

/*
else{
    echo"Succesfull";
} */


?>