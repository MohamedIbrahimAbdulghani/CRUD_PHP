<?php


$error_message = "";
$success_message = "";

// this function to check a name is required or not
function requiredInput($value) {
    $str = trim($value);
    if(strlen($str) > 0) {
        return true;
    } else {
        return false;
    }
}

// this function to check the minimum number
function minInput($value, $min) {
    if(strlen($value) < $min) {
        return false;
    } else {
        return true;
    }
}

// this function to check the maximum number
function maxInput($value, $max) {
    if(strlen($value) > $max) {
        return false;
    } else {
        return true;
    }
}

// validate email
function validEmail($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}