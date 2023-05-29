<?php

include("db.php");

if (isset($_POST['submit'])) {

    $email = $_POST['email_user'];
    $username = $_POST['email_user'];
    $password = $_POST['password'];

    if (empty($email)) {
        $email_err = "Email/Username is required ! ";
    }
    if (empty($password)) {
        $password_err = "Password is required ! ";
    }
    $password = md5($password);

    if (!empty($email) || !empty($password)) {
        $login_users = "SELECT * FROM users WHERE `email`='$email' OR `username`='$username' AND `password`='$password'";
        $login_exe = mysqli_query($con, $login_users);
        $login_data = mysqli_fetch_assoc($login_exe);

        if ($login_data) {
            $_SESSION['admin'] = $login_data;
            header('location:table.php');
        } else {
            $error = "Invalid email and password !";
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .error {
            font-weight: bold;
            color: red;
            <?php if (
                isset($email_err) || isset($password_err) || isset($error) 
            ) { ?>
                margin-top: 6px;
                margin-bottom: 12px;
            <?php } ?>
        }
     
            input{
                width: 50%;
                height: 40px;
            }
        
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <h1 class="mb-3">Login</h1>
                <form action="" method="post">
                    <label for="email" class="mb-1">Email/Username : </label><br>
                    <input type="text" name="email_user" id=""><br><br>
                    <div class="error">
                        <?php if (isset($email_err)) { ?>
                            <?php echo $email_err; ?>
                        <?php } ?>
                    </div>

                    <label for="password" class="mb-1">Password : </label><br>
                    <input type="password" name="password" id=""><br><br>
                    <div class="error">
                        <?php if (isset($password_err)) { ?>
                            <?php echo $password_err; ?>
                        <?php }  elseif (isset($error)) { ?>
                            <?php echo $error; ?>
                        <?php } ?>
                    </div>
                    <input type="submit" value="login" class="btn btn-success" name="submit">
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