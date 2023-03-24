<!-- PHP -->
<?php

session_start();

require_once '../components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

$sql = "SELECT * FROM animals";
$result = mysqli_query($connect, $sql);
$tbody = ''; //this variable will hold the body for the table

if (mysqli_num_rows($result)  > 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "
        <tr>
            <td><img class='img-thumbnail' src='../pictures/" . $row['picture'] . "'</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['fk_address_id'] . "</td>
            <td>" . $row['size'] . "</td>
            <td>" . $row['age'] . "</td>
            <td>" . $row['vaccines'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td>" . $row['status'] . "</td>
            <td>
                <a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
                <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a>
            </td>
        </tr>";
    };

} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);

?>
<!-- /php -->

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

    <!-- HEAD -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>PHP CRUD</title>

        <?php require_once '../components/boot.php' ?>

        <!-- CSS -->
        <style type="text/css">

            .manageProduct {
                margin: auto;
            }

            .img-thumbnail {
                width: 70px !important;
                height: 70px !important;
            }

            td {
                text-align: left;
                vertical-align: middle;
            }

            tr {
                text-align: center;
            }

        </style>
        <!-- /css -->

    </head>
    <!-- /head -->

    <!-- BODY -->
    <body>
        <div class="manageProduct w-75 mt-3">

            <div class='mb-3'>
                <a href="create.php"><button class='btn btn-primary' type="button">Add Animal</button></a>
                <a href="../dashboard.php"><button class='btn btn-success' type="button">Dashboard</button></a>
            </div>

            <p class='h2'>List of Animals</p>

            <table class='table table-striped'>

                <thead class='table-success'>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Size</th>
                        <th>Age</th>
                        <th>Vaccines</th>
                        <th>Breed</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?= $tbody; ?>
                </tbody>

            </table>

        </div>
    </body>
    <!-- /body -->

</html>
<!-- /html -->
