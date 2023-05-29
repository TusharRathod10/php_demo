<?php

include("db.php");

$select_data = "SELECT * FROM users";
$select_exe = mysqli_query($con, $select_data);

if (isset($_GET['view_id'])) {
    $view_id = base64_decode($_GET['view_id']);

    $get_data = "SELECT * FROM users WHERE `id`='$view_id' ";
    $data_exe = mysqli_query($con, $get_data);
    $view = mysqli_fetch_assoc($data_exe);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <style>
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
                <h1 class="mb-3">VIEW DATA</h1>
                <form action="" method="post">
                    <label for="username" class="mb-1">Username : </label><br>
                    <input type="text" name="username" id="" value="<?php echo $view['username']; ?>" disabled><br><br>

                    <label for="email" class="mb-1">Email : </label><br>
                    <input type="text" name="email" id="" value="<?php echo $view['email']; ?>" disabled><br><br>

                    <label for="country" class="mb-1">Country : </label><br>
                    <input type="text" name="country" id="" value="<?php echo $view['country']; ?>" disabled><br><br>

                    <label for="hobby" class="mb-1">Hobby : </label><br>
                    <input type="text" name="hobby" id="" value="<?php echo $view['hobby']; ?>" disabled><br><br>

                    <label for="gender" class="mb-1">Gender : </label><br>
                    <input type="text" name="gender" id="" value="<?php echo $view['gender']; ?>" disabled><br><br>

                    <label for="dob" class="mb-1">Date Of Birth : </label><br>
                    <input type="text" name="dob" id="" value="<?php echo $view['dob']; ?>" disabled><br><br>

                    <label for="profile" class="mb-1">Profile : </label><br>
                    <input type="text" name="profile" id="" value="<?php echo $view['profile']; ?>" disabled><br><br>

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