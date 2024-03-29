<!-- PHP -->
<?php

session_start();

require_once 'components/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id = $_SESSION['adm'];
$status = 'adm';
$sql = "SELECT * FROM users WHERE status != '$status'";
$result = mysqli_query($connect, $sql);

//this variable will hold the body for the table
$tbody = '';

if ($result->num_rows > 0) {

    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "
        <tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phone_number'] . "</td>
            <td>" . $row['fk_address_id'] . "</td>
            <td>" . $row['password'] . "</td>
            <td>" . $row['status'] . "</td>
            <td>" . $row['picture'] . "</td>
            <td><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
        </tr>";
    }

} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
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

    <title>Adm-Dashboard</title>

    <?php require_once 'components/boot.php' ?>

    <!-- CSS -->
    <style type="text/css">
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

        .userImage {
            width: 100px;
            height: auto;
        }
    </style>
    <!-- /css -->

</head>
<!-- /head -->

<!-- BODY -->
<body>
    <div class="container">

        <!-- ROW -->
        <div class="row">

            <!-- COLUMN -->
            <div class="col-2">
                <img class="userImage" src="pictures/admavatar.png" alt="Adm avatar">
                <p class="">Administrator</p>
                <a class="btn btn-success" href="products/index.php">Animals</a>
                <a class="btn btn-danger" href="logout.php?logout">Sign Out</a>
            </div>
            <!-- /column -->

            <!-- COLUMN -->
            <div class="col-8 mt-2">
                <p class='h2'>Users</p>

                <table class='table table-striped'>

                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address_Id</th>
                            <th>Password</th>
                            <th>Status</th>
                            <th>Picture</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?= $tbody ?>
                    </tbody>

                </table>

            </div>
            <!-- /column -->

        </div>
        <!-- /row -->

    </div>
</body>
<!-- /body -->

</html>
<!-- /html -->
