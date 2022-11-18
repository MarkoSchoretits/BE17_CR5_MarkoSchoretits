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

$address = "";
$result = mysqli_query($connect, "SELECT * FROM address");

while ($row_add = $result->fetch_array(MYSQLI_ASSOC)) {
    $address .=
        "<option value='{$row_add['id']}'>{$row_add['street']}</option>";
}

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['name'];
        $add = $data['fk_address_id'];
        $description = $data['description'];
        $size = $data['size'];
        $age = $data['age'];
        $vaccines = $data['vaccines'];
        $breed = $data['breed'];
        $status = $data['status'];
        $picture = $data['picture'];
        $resultSup = mysqli_query($connect, "SELECT * FROM `address`");
        $addList = "";
        if (mysqli_num_rows($resultSup) > 0) {
            while ($row = $resultSup->fetch_array(MYSQLI_ASSOC)) {
                if ($row['id'] == $add) {
                    $addList .= "<option selected value='{$row['id']}'>{$row['street']}</option>";
                } else {
                    $addList .= "<option value='{$row['id']}'>{$row['street']}</option>";
                }
            }
        } else {
            $supList = "<li>There are no addresses registered</li>";
        }
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Animal</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
    </style>
</head>

<body>
    <fieldset>
        <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><input class="form-control" type="text" name="name" placeholder="Product Name" value="<?php echo $name ?>" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="description" placeholder="Description" value="<?php echo $description ?>" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class="form-control" list="sizeOptions" name="size" placeholder="Size" value="<?php echo $size ?>" />
                    <datalist id="sizeOptions">
                        <option value="small">
                        <option value="BIG">
                    </datalist>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" placeholder="Age" step="any" value="<?php echo $age ?>" /></td>
                </tr>
                <tr>
                    <th>Vaccines</th>
                    <td><input class='form-control' type="text" name="vaccines" placeholder="Vaccines" value="<?php echo $vaccines ?>" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="Breed" value="<?php echo $breed ?>" /></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><input class="form-control" list="statusOptions" name="status" placeholder="Status" value="<?php echo $status ?>" />
                    <datalist id="statusOptions">
                        <option value="available">
                        <option value="adopted">
                    </datalist>
                </td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture" value="<?php echo $picture ?>" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>
                        <select class="form-select" name="address" aria-label="Default select example">
                            <?php echo $address; ?>
                            <option selected value='none'>Undefined</option>
                        </select>
                    </td>
                </tr>


                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $data['picture'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>