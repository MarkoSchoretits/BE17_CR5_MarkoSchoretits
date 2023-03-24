<!-- PHP -->
<?php

session_start();

require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$row_u = mysqli_fetch_array($res, MYSQLI_ASSOC);
$sql = "SELECT * FROM animals WHERE age >= 8";
$result = mysqli_query($connect, $sql);
$tbody = ''; //this variable will hold the body for the table

if (mysqli_num_rows($result)  > 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        $tbody .= "
        <tr>
            <td><img class='img-thumbnail' src='pictures/" . $row['picture'] . "'</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['size'] . "</td>
            <td>" . $row['age'] . "</td>
            <td>" . $row['vaccines'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td>" . $row['status'] . "</td>
            <td>
                <a href='details.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Details</button></a>
                <a href='adopt.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Adopt</button></a>
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

    <title>Welcome - <?php echo $row['first_name']; ?></title>

    <?php require_once 'components/boot.php' ?>

    <!-- Css -->
    <style>
        .userImage {
            width: 200px;
            height: 200px;
        }

        .hero {
            background: rgb(2, 0, 36);
            background: linear-gradient(24deg, rgba(2, 0, 36, 1) 0%, rgba(0, 212, 255, 1) 100%);
        }
    </style>

</head>
<!-- /head -->

<!-- BODY -->
<body>
    <div class="container">

        <!-- HERO -->
        <div class="hero">
            <img class="userImage" src="pictures/<?php echo $row_u['picture']; ?>" alt="<?php echo $row_u['first_name']; ?>">
            <p class="text-white">Hello <?php echo $row_u['first_name'];?> (<?php echo $row_u['email'];?> )</p>
        </div>
        <!-- /hero -->

        <div class="manageProduct w-75 mt-3">

            <a href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a><br>
            <a href="logout.php?logout">Sign Out</a><br><br>

<!-- 
            <div class='mb-3'>
                <a href="create.php"><button class='btn btn-primary' type="button">Add product</button></a>
                <a href="../dashboard.php"><button class='btn btn-success' type="button">Dashboard</button></a>
            </div>
-->

            <p class='h2'>These are our senior Animals</p>
            <a href='home.php?'><button class='btn btn-primary btn-sm' type='button'>Show all ages!</button></a><br><br>

            <table class='table table-striped'>

                <thead class='table-success'>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Age</th>
                        <th>Vaccines</th>
                        <th>Breed</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?= $tbody; ?>
                </tbody>

            </table>

        </div>

    </div>
</body>
<!-- /body -->

</html>
<!-- /html -->