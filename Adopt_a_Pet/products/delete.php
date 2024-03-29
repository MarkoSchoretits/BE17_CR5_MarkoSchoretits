<!-- PHP -->
<?php

session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 1) {
        $name = $data['name'];
        $description = $data['description'];
        $size = $data['size'];
        $age = $data['age'];
        $vaccines = $data['vaccines'];
        $breed = $data['breed'];
        $status = $data['status'];
        $picture = $data['picture'];
        $add = $data['fk_address_id'];

    } else {
        header("location: error.php");
    }

    mysqli_close($connect);

} else {
    header("location: error.php");
}

?>
<!-- /php -->

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

    <!-- HEAD -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Delete Animal</title>

        <?php require_once '../components/boot.php' ?>

        <!-- CSS -->
        <style type="text/css">

        fieldset {
                margin: auto;
                margin-top: 100px;
                width: 70%;
            }

            .img-thumbnail {
                width: 70px !important;
                height: 70px !important;
            }

        </style>
        <!-- /css -->

    </head>
    <!-- /head -->

    <!-- BODY -->
    <body>
        <fieldset>

            <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>

            <h5>You have selected the data below:</h5>

            <table class="table w-75 mt-3">
                <tr>
                    <td><?php echo $name ?></td>
                    <td><?php echo $breed ?></td>
                    <td><?php echo $description ?></td>
                    <td><?php echo $add ?></td>
                </tr>
            </table>

            <h3 class="mb-4">Do you really want to delete this product?</h3>

            <form action="actions/a_delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                <button class="btn btn-danger" type="submit">Yes, delete it!</button>
                <a href="index.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
            </form>

        </fieldset>
    </body>
    <!-- /body -->

</html>
<!-- /html -->
