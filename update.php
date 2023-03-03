<?php

    require_once "include/header.php";
    require_once "functions/validation.php";
    require_once "functions/db.php";

    if(isset($_POST["submit"])):
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        if(requiredInput($name) && requiredInput($email)):
            if(minInput($name, 3)):
                if(validEmail($email)):
                    $id = $_POST["id"];
                    if($password):
                        $password = filter_var($_POST["password"], PASSWORD_DEFAULT);
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "UPDATE `users` SET `user_name` = '$name', `user_email` = '$email', `user_password` = '$password' WHERE `user_id` = '$id' ";
                    else:
                        $sql = "UPDATE `users` SET `user_name` = '$name', `user_email` = '$email' WHERE `user_id` = '$id' ";
                    endif;
                    $result = mysqli_query($connection_database, $sql);
                    if($result):
                        $success_message = "Updated Successfully";
                        header("refresh:1;url=index.php");
                    endif;
                else:
                    $error_message = "Please Type Valid Email!";
                endif;
            else:
                $error_message = "Name Must Be Grater Than 3 Chars / Password Must Be Less Than 20 Chars";
            endif;
        else:
            $error_message = "Please Fill All Fields!";
        endif;

    endif;
?>



<h1 class="text-center col-12 bg-info py-3 text-white my-2">Update Info About User</h1>

<?php if($error_message): ?>
        <h5 class="alert alert-danger text-center"><?php echo $error_message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h5>
        <!-- this code to make input to back 1 step by javascript history -->
        <a href="javascript:history.go(-1)" class="btn btn-primary"><< Go Back</a>
    <?php endif; ?>

    <?php if($success_message): ?>
        <h5 class="alert alert-success text-center"><?php echo $success_message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h5>
    <?php endif; ?>


<?php require_once "include/footer.php"; ?>