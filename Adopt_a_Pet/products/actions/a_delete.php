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

if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture == "animal.png") ?: unlink("../../pictures/$picture");

    $sql = "DELETE FROM animals WHERE id = {$id}";

    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Successfully Deleted!";

    } else {
        $class = "danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
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
        <title>Delete Animal</title>
        <?php require_once '../../components/boot.php' ?>
    </head>
    <!-- /head -->

    <!-- BODY -->
    <body>
        <div class="container">

            <div class="mt-3 mb-3">
                <h1>Delete request response</h1>
            </div>

            <div class="alert alert-<?= $class; ?>" role="alert">
                <p><?= $message; ?></p>
                <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>

        </div>
    </body>
    <!-- /body -->

</html>
<!-- /html -->
