<?php

include("db.php");

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ((isset($username) && empty($username)) || (isset($email) && empty($email)) || (isset($password) && empty($password)) || (isset($cpassword) && empty($cpassword))) {

        if (empty($username)) {
            $username_err = "Username is required ! ";
        }
        if (empty($email)) {
            $email_err = "Email is required ! ";
        }
        if (empty($password)) {
            $password_err = "Password is required ! ";
        }
        if (empty($cpassword)) {
            $cpassword_err = "Confirm Password is required ! ";
        }

    } elseif (!empty($username) && !empty($email) && !empty($password) && !empty($cpassword)) {
        $pass_length = strlen($password);
        $split_email = explode('@', $email);

        if ($password != $cpassword) {
            $match_err = "Password Not Matched !";
        } elseif ($pass_length < 8) {
            $length_err = "Password Length must be 8 characters !";
        } elseif (($split_email[1] != 'gmail.com') && ($split_email[1] != 'mailinator.com')) {
            $mail_only = "Please Enter Valid Mail !";
        } else {
            $user = "SELECT username FROM users WHERE `username`='$username'";
            $user_exe = mysqli_query($con, $user);
            $user_count = mysqli_num_rows($user_exe);

            $euser = "SELECT email FROM users WHERE `email`='$email'";
            $euser_exe = mysqli_query($con, $euser);
            $euser_count = mysqli_num_rows($euser_exe);

            if ($user_count > 0) {
                $urepeat = "Username Already Exists !";
            } elseif ($euser_count > 0) {
                $erepeat = "Email Already Exists !";
            } else {
                $password = md5($password);
                $insert = "INSERT INTO users (`username`,`email`,`password`) VALUES ('$username','$email','$password')";
                $insert_exe = mysqli_query($con, $insert);
                header("location:table.php");
            }
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        
            input{
                width: 50%;
                height: 40px;
            }
        
        .error {
            font-weight: bold;
            color: red;
            <?php if (
                isset($username_err) || isset($email_err) || isset($password_err) || isset($cpassword_err) || isset($match_err) || isset($length_err) || isset($mail_only) || isset($erepeat) || isset($urepeat)
            ) { ?>
                margin-top: 6px;
                margin-bottom: 12px;
            <?php } ?>
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <h1 class="mb-3">Register</h1>
                <form action="" method="post">
                    <label for="username" class="mb-1">Username : </label><br>
                    <input type="text" name="username" id=""><br><br>
                    <div class="error">
                        <?php if (isset($username_err)) { ?>
                            <?php echo $username_err; ?>
                        <?php } ?>
                        <?php if (isset($urepeat)) { ?>
                            <?php echo $urepeat; ?>
                        <?php } ?>
                    </div>
                    <label for="email" class="mb-1">Email : </label><br>
                    <input type="email" name="email" id=""><br><br>
                    <div class="error">
                        <?php if (isset($email_err)) { ?>
                            <?php echo $email_err; ?>
                        <?php } ?>
                        <?php if (isset($mail_only)) { ?>
                            <?php echo $mail_only; ?>
                        <?php } ?>
                        <?php if (isset($erepeat)) { ?>
                            <?php echo $erepeat; ?>
                        <?php } ?>
                    </div>

                    <label for="password" class="mb-1">Password : </label><br>
                    <input type="password" name="password" id=""><br><br>
                    <div class="error">
                        <?php if (isset($password_err)) { ?>
                            <?php echo $password_err; ?>
                        <?php } ?>
                    </div>
                    <label for="cpassword" class="mb-1">Confirm password : </label><br>
                    <input type="password" name="cpassword" id=""><br><br>
                    <div class="error">
                        <?php if (isset($cpassword_err)) { ?>
                            <?php echo $cpassword_err; ?>
                        <?php } ?>
                        <?php if (isset($match_err)) { ?>
                            <?php echo $match_err; ?>
                        <?php } ?>
                        <?php if (isset($length_err)) { ?>
                            <?php echo $length_err; ?>
                        <?php } ?>
                    </div>

                    <input type="submit" value="register" class="btn btn-success" name="submit">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script> if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }</script>
</body>

</html>