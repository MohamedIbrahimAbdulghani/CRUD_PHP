<?php

$server = "localhost";
$user = "root";
$password = "";
$bdname = "crud_database";

$connection_database = mysqli_connect($server, $user, $password, $bdname);
if(!$connection_database) {
    die("Connection Failed: " . mysqli_connect_error());
} 


// to insert data to database

function addUsers($name, $email, $password) {
    global $connection_database;
    $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES ('$name', '$email', '$password') ";
    $result = mysqli_query($connection_database, $sql);
    if($result) {
        return true;
    } else {
        return false;
    }
}