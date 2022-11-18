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
    $uploadError = '';
    //this function exists in the service file upload.
    $picture = file_upload($_FILES['picture'], 'animal');
/* 
    if ($address == 'none') {
        //checks if the supplier is undefined and insert null in the DB
        $sql = "INSERT INTO animals (`name`, `description`, `size`, `age`, `vaccines`, `breed`, `status`, `picture`, `fk_address_id`) VALUES ('$name', $description, '$size', '$age', '$vaccines', '$breed', '$status', '$picture->fileName', 'null')";
    } else { */
        $sql = "INSERT INTO animals (`name`, `description`, `size`, `age`, `vaccines`, `breed`, `status`, `picture`, `fk_address_id`) VALUES ('$name', '$description', '$size', '$age', '$vaccines', '$breed', '$status', '$picture->fileName', '$address')";
/*     }
 */
    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $name </td>
            <td> $breed </td>
            <td> $description </td>
            </tr></table><hr>";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../../components/boot.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>