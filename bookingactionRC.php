<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);



$servername = "localhost";
$username = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $username, $password, $database);
session_start();

$msg = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    echo $name;
    // $user_id= $_POST['userid'];
    // echo $user_id;
    $veh_no = $_POST['vehno'];
    $veh_type = $_POST['vehtype'];
    $rc_no = $_POST['vehno'];
    $owner = $_POST['ownname'];
    $date_of_reg = $_POST['dateofreg'];
    $reg_validity = $_POST['regvalidity'];
    $engine_no = $_POST['engineno'];
    $chassis_no = $_POST['chassisno'];
    $rto_name = $_POST['rtoname'];
    $fuel_type = $_POST['fueltype'];
    $emission_norms = $_POST['enorm'];

    $engine_cc = $_POST['enginecc'];
    $username = $_POST['username'];

    $insert_query = "UPDATE reg_certificate SET reg_validity = '$reg_validity' WHERE rc_no = '$rc_no';";


    try {

        $res = mysqli_query($connection, $insert_query);
        $docRC_insert = "UPDATE `documents` SET `rc_no` = '$rc_no' WHERE `documents`.`veh_no` = '$veh_no';";
        $docRC_res = mysqli_query($connection, $docRC_insert);

        if ($res == true && $docRC_res == true) {
            $msg = "<script language='javascript'>
                swal(
                    'Success!',
                    'RC Inserted in DB!',
                    'success'
                );
                </script>";
        } else {
            die('unsuccessful' . mysqli_error($connection));
        }
    } catch (Exception $e) {
        echo "ERROR->" . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link rel="stylesheet" href="sweetalert2/sweetalert2.css">
    <script src="sweetalert2/sweetalert2.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
    <?php echo $msg;
    ?>

    <script>
        var timer = setTimeout(function() {
            window.location = 'documents.php?id=<?php echo $veh_no; ?>'
        }, 2000);
    </script>

</body>

</html>