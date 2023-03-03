<?php

    require_once "include/header.php";
    require_once "functions/validation.php";

    if(!isset($_GET["id"]) || !is_numeric($_GET["id"])):
        header("Location: index.php");
    endif;


    $id = $_GET["id"];
    $return_id = checkId($id);


    $sql = "DELETE FROM `users` WHERE `user_id` = '$id' ";
    $result = mysqli_query($connection_database, $sql);
    
    

?>


<h1 class="text-center col-12 bg-danger py-3 text-white my-2"> User Have Been Delete</h1>

<?php header("refresh:1;url=index.php"); ?>

<?php require_once "include/footer.php"; ?>