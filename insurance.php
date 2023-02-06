<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (!isset($_SESSION)) {

    session_start();
}
$veh_no = $_GET['id'];
$username = $_SESSION['username'];
echo $username;

$servername = "localhost";
$usernam = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $usernam, $password, $database);

$uid_query = "SELECT user_id FROM user WHERE username = '$username';";
$uid_res = mysqli_query($connection, $uid_query);
$userid = mysqli_fetch_assoc($uid_res);
$user_id = $userid['user_id'];

$query = "SELECT * FROM insurance where veh_no = '$veh_no' AND user_id = $user_id ;";

$result = mysqli_query($connection, $query);
// echo print_r(var_mysqli_fetch_assoc($result));
// echo print_r(mysqli_fetch_assoc($result));


$insno_query = "SELECT insurance_no FROM insurance WHERE user_id = $user_id AND veh_no = '$veh_no';";
$insno_res = mysqli_query($connection, $insno_query);
$insno_ar = mysqli_fetch_assoc($insno_res);
print_r($insno_ar);
$insno = $insno_ar['insurance_no'];
echo $insno;




// if (isset($_POST['pdfgen'])) {
//     require_once('tcpdf/tcpdf.php');
//     $content = '';
//     $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//     $obj_pdf->SetCreator(PDF_CREATOR);
//     $obj_pdf->SetTitle("This is an export from php");
//     $obj_pdf->setHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
//     $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//     $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//     $obj_pdf->SetDefaultMonospacedFont('helvetica');
//     $obj_pdf->setFooterMargin(PDF_MARGIN_FOOTER);
//     $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
//     $obj_pdf->setPrintHeader(false);
//     $obj_pdf->setPrintFooter(false);
//     $obj_pdf->SetAutoPageBreak(true, 10);
//     $obj_pdf->SetFont('helvetica', '', 12);
//     $obj_pdf->AddPage();

//     $content .= `<h1>Heeeyyyy!</h1>`;





//     $obj_pdf ->writeHTML($content);
//     $obj_pdf->Output(sample.pdf);




//     // echo 'Working!'; 
// } 




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Insurance</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 style="text-align: center;">Insurance Details</h1>
            </div>
        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Insurance No.</th>
                        <th>Vehicle No.</th>
                        <th>Chassis No.</th>
                        <th>Owner Name</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Insurance Status</th>
                        <th>Insurance Expiry</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $exp_date = $row['insurance_expiry'];
                        echo $exp_date;
                        $proc_call = mysqli_query($connection, "CALL STATUS('$veh_no','$exp_date',$user_id);");
                        echo var_dump($proc_call);
                    ?>
                        <tr>
                            <td><?php echo $insno ?></td>
                            <td><?php echo $row['veh_no']; ?></td>
                            <td><?php echo $row['chassis_no']; ?></td>
                            <td><?php echo $row['owner_name']; ?></td>
                            <td><?php echo $row['maker']; ?></td>
                            <td><?php echo $row['model']; ?></td>
                            <td><?php
                                echo $row['insurance_status'];
                                ?></td>
                            <td><?php echo $row['insurance_expiry']; ?></td>


                        </tr>
                </tbody>

            <?php } ?>
            </table>
            <form method="post">
                <input type="submit" value="Convert to PDF" name="pdfgen" class="btn btn-success">
            </form>
        </div>
    </div>
</body>

</html>