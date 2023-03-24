<!-- PHP -->
<?php

session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}

require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if ($_POST) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $vaccines = $_POST['vaccines'];
    $breed = $_POST['breed'];
    $status = $_POST['status'];
    $address = $_POST['address'];
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    //variable for upload pictures errors is initialised
    $uploadError = '';
    $picture = file_upload($_FILES['picture'], 'animal'); //file_upload() called  

    if ($picture->error === 0) {
        ($_POST["picture"] == "animal.png") ?: unlink("../../pictures/$_POST[picture]");
        $sql = "UPDATE animals SET `name` = '$name', `description` = '$description', `size` = '$size', `age` = '$age', `vaccines` = '$vaccines', `breed` = '$breed', `status` = '$status', `fk_address_id` = '$address', `picture` = '$picture->fileName' WHERE id = {$id}";

    } else {
        $sql = "UPDATE animals SET `name` = '$name', `description` = '$description', `size` = '$size', `age` = '$age', `vaccines` = '$vaccines', `breed` = '$breed', `status` = '$status', `fk_address_id` = '$address' WHERE id = {$id}";
    }

    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';

    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }

    mysqli_close($connect);

} else {
    header("location: ../error.php");
}

?>
<!-- /php -->

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

    <!-- HEAD -->
    <head>
        <meta charset="UTF-8">
        <title>Update</title>
        <?php require_once '../../components/boot.php' ?>
    </head>
    <!-- /head -->

    <!-- BODY -->
    <body>
        <div class="container">

            <div class="mt-3 mb-3">
                <h1>Update request response</h1>
            </div>

            <div class="alert alert-<?php echo $class; ?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../update.php?id=<?= $id; ?>'><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>

        </div>
    </body>
    <!-- /body -->

</html>
<!-- /html -->
