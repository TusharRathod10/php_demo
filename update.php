<?php

include("db.php");

$select_data = "SELECT * FROM users";
$select_exe = mysqli_query($con, $select_data);

if (isset($_GET['update_id'])) {
    $update_id = base64_decode($_GET['update_id']);

    $get_data = "SELECT * FROM users WHERE `id`='$update_id' ";
    $data_exe = mysqli_query($con, $get_data);
    $data_arr = mysqli_fetch_assoc($data_exe);
    $hobby = explode(" , ", $data_arr['hobby']);
}

if (isset($_POST['submit'])) {
    $id = base64_decode($_GET['update_id']);

    $newname = $_POST['username'] ? $_POST['username'] : $data_arr['username'];
    $newemail = $_POST['email'] ? $_POST['email'] : $data_arr['email'];
    $newhobby = $_POST['hobby'] ? $_POST['hobby'] : $hobby;
    $newgender = $_POST['gender'] ? $_POST['gender'] : $data_arr['gender'];
    $newcountry = $_POST['country'] ? $_POST['country'] : $data_arr['country'];
    $newdob = $_POST['dob'] ? $_POST['dob'] : $data_arr['dob'];
    $newhobby = implode(" , ", $newhobby);

    $explode = explode('.', $_FILES['profile']['name']);
    $extension = end($explode);
    $image = time() . '.' . $extension;
    $tmp_name = $_FILES['profile']['tmp_name'];
    $file = 'img/' . $image;
    $move = move_uploaded_file($tmp_name, $file);

    $data_update = "UPDATE users SET `username`='$newname',`email`='$newemail',`dob`='$newdob',`hobby`='$newhobby',`gender`='$newgender',`country`='$newcountry',`profile`='$image' WHERE `id`='$id'";
    $updated_data_exe = mysqli_query($con, $data_update);

    if ($updated_data_exe) {
        header('location:table.php');
    } else {
        $error = "Something went wrong";
    }
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
            .input{
                width: 50%;
                height: 40px;
            }
            select{
                width: 50%;
                height: 40px;
            }
        </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <h1 class="mb-3">Update</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="username" class="mb-1">Username : </label><br>
                    <input type="text" class="input" name="username" id="" value="<?php echo $data_arr['username'] ?>"><br><br>

                    <label for="email" class="mb-1">Email : </label><br>
                    <input type="email" name="email" class="input" id="" value="<?php echo $data_arr['email'] ?>"><br><br>

                    <label for="country" class="mb-1">Country : </label><br>
                    <select name="country" id="">
                        <option value="0" hidden selected>Select Country</option>
                        <option value="india" <?php if ($data_arr['country'] == 'india') {
                            echo 'selected';
                        } ?>>INDIA</option>
                        <option value="usa" <?php if ($data_arr['country'] == 'usa') {
                            echo 'selected';
                        } ?>>USA</option>
                        <option value="uk" <?php if ($data_arr['country'] == 'uk') {
                            echo 'selected';
                        } ?>>UK</option>
                        <option value="canada" <?php if ($data_arr['country'] == 'canada') {
                            echo 'selected';
                        } ?>>CANADA
                        </option>
                        <option value="germany" <?php if ($data_arr['country'] == 'germany') {
                            echo 'selected';
                        } ?>>GERMANY</option>
                    </select><br><br>

                    <label for="hobby" class="mb-1">Hobby : </label><br>
                    <input type="checkbox" name="hobby[]" id="" value="cricket" <?php if (in_array('cricket', $hobby)) {
                        echo 'checked';
                    } ?>> CRICKET<br>
                    <input type="checkbox" name="hobby[]" id="" value="football" <?php if (in_array('football', $hobby)) {
                        echo 'checked';
                    } ?>> FOOTBALL<br>
                    <input type="checkbox" name="hobby[]" id="" value="travelling" <?php if (in_array('travelling', $hobby)) {
                        echo 'checked';
                    } ?>> TRAVELLING<br><br>

                    <label for="gender" class="mb-1">Gender : </label><br>
                    <input type="radio" name="gender" id="" value="male" <?php if ($data_arr['gender'] == 'male') {
                        echo 'checked';
                    } ?>> MALE <br>
                    <input type="radio" name="gender" id="" value="female" <?php if ($data_arr['gender'] == 'female') {
                        echo 'checked';
                    } ?>> FEMALE <br><br>

                    <label for="dob" class="mb-1">Date Of Birth : </label><br>
                    <input type="date" name="dob" class="input" id="" value="<?php echo $data_arr['dob'] ?>"><br><br>

                    <label for="profile" class="mb-1">Profile : </label><br>
                    <input type="file" name="profile" id=""><br><br>

                    <input type="submit" value="Update" class="btn btn-success" name="submit">
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