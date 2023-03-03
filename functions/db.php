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
    $query = mysqli_query($connection_database, $sql);
    if($query) {
        return true;
    } else {
        return false;
    }
}

// to select data from database
function getUsers() {
    global $connection_database;
    $sql = "SELECT * FROM `users` ";
    $query = mysqli_query($connection_database, $sql);

    $result_users = [];
    while($result = mysqli_fetch_assoc($query)) {
        $result_users[] = $result;
    }
    return $result_users;

}

// this function to check id from database
function checkId($id) {
    global $connection_database;
    $sql = "SELECT * FROM `users` WHERE `user_id` = $id ";
    $result = mysqli_query($connection_database, $sql);
    $check = mysqli_num_rows($result);
    if(!$check) {
        header("Location: index.php");
    }
}