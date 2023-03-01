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
<h1 class="text-center col-12 bg-info py-3 text-white my-2 alert-dismissible fade show" role="alert">Add New User</h1>
    <?php if($error_message): ?>
        <h5 class="alert alert-danger text-center"><?php echo $error_message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h5>
    <?php endif; ?>

    <?php if($success_message): ?>
        <h5 class="alert alert-success text-center"><?php echo $success_message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h5>
    <?php endif; ?>

    <div class="col-md-6 offset-md-3">
        <form class="my-2 p-3 border" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
            <div class="form-group">
                <label for="exampleInputName1">Full Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName1" >
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Email address</label>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
         
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
   

    <?php require_once "include/footer.php"; ?>