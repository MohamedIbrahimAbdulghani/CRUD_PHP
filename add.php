<?php

    require_once "include/header.php";
    require_once "functions/validation.php";
    require_once "functions/db.php";

    if(isset($_POST["submit"])):
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

        if(requiredInput($name) && requiredInput($email) && requiredInput($password)):
            if(minInput($name, 3) && maxInput($password, 20)):
                if(validEmail($email)):
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $result = addUsers($name, $email, $hashed_password);
                    if($result):
                        $success_message = "Added Successfully";
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


    <?php require_once "include/footer.php"; ?>