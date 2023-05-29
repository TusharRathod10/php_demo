<?php

include("db.php");

$select_data = "SELECT * FROM users";
$select_exe = mysqli_query($con, $select_data);

if (isset($_GET['delete_id'])) {
    $id = base64_decode($_GET['delete_id']);
    $select_data1 = "SELECT * FROM users WHERE `id`='$id'";
    $select_exe1 = mysqli_query($con, $select_data1);
    $data = mysqli_fetch_assoc($select_exe1);
    $image = $data['profile'];

    if (unlink('img/' . $image)) {
        $delete_data = "DELETE FROM users WHERE `id`='$id'";
        $delete_exe = mysqli_query($con, $delete_data);
        header('location:table.php');
    } else {
        $derror = "Something went wrong.";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Country</th>
                            <th scope="col">Hobby</th>
                            <th scope="col">Gender</th>
                            <th scope="col">DOB</th>
                            <th scope="col">Profile</th>
                            <th scope="col">View</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($select_exe)) { ?>
                            <tr>
                                <td>
                                    <?php echo $data['username'] ?>
                                </td>
                                <td>
                                    <?php echo $data['email'] ?>
                                </td>
                                <td>
                                    <?php echo $data['country'] ?>
                                </td>
                                <td>
                                    <?php echo $data['hobby'] ?>
                                </td>
                                <td>
                                    <?php echo $data['gender'] ?>
                                </td>
                                <td>
                                    <?php echo $data['dob'] ?>
                                </td>
                                <td>
                                    <?php echo $data['profile'] ?>
                                </td>
                                <td><a href="view.php?view_id=<?php echo base64_encode($data['id']);?>"><button class="btn btn-secondary btn-circle"><i
                                                class="fa fa-eye"></i></button></a></td>
                                <td><a href="update.php?update_id=<?php echo base64_encode($data['id']); ?>"><button
                                            class="btn btn-primary btn-circle"><i class="fa fa-edit"></i></button></a></td>
                                <td><a href="table.php?delete_id=<?php echo base64_encode($data['id']); ?>"><button
                                            class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <a href="logout.php"><i class="icon-key"></i> <button class="btn btn-success">Logout</button></a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>