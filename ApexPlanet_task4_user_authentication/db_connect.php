<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "user_auth_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database Connection Failed!");
}

?>