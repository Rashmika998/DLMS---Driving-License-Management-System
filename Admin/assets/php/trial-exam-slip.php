<?Php
ob_start();
require_once 'config.php';

$success = 0;
if (!isset($_SESSION['loggedin_admin'])) {
    header('Location: Admin-Login.php');
    exit;
} else {
    $admin_username = $_SESSION['admin_uname'];
    $asql = "SELECT * FROM admin WHERE admin_username='" . $admin_username . "'";
    $arecords = mysqli_query($link, $asql);
    $adata = mysqli_fetch_assoc($arecords);
}

require('../../fpdf.php');
$u_id = $_GET['user_id'];

$sql = "SELECT * FROM users WHERE user_id='" . $u_id . "'";
$records = mysqli_query($link, $sql);
$data_1 = mysqli_fetch_assoc($records);

$sql1 = "SELECT * FROM user_details WHERE user_id='" . $u_id . "'";
$records1 = mysqli_query($link, $sql1);
$data_2 = mysqli_fetch_assoc($records1);

$sql3 = "SELECT * FROM written_exam WHERE user_id='" . $u_id . "'";
$records3 = mysqli_query($link, $sql3);
$data_3 = mysqli_fetch_assoc($records3);

$sql4 = "SELECT * FROM written_payment WHERE user_id='" . $u_id . "'";
$records4 = mysqli_query($link, $sql4);
$data_4 = mysqli_fetch_assoc($records4);

$sql5 = "SELECT * FROM trial_exam WHERE user_id='" . $u_id . "'";
$records5 = mysqli_query($link, $sql5);
$data_5 = mysqli_fetch_assoc($records5);


$pdf = new FPDF('p', 'mm', 'A4');
$pdf->AddPage();
$pdf->Rect(5, 5, 200, 287, 'D'); //For A4
$pdf->Image('emblem.png', 10, 6, 24, 35);
//$pdf->Image('logo.jpeg',150,20,54,16);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'DEPARTMENT OF MOTR TRAFFIC', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Motor Traffic Act Chapter 203', 0, 1, 'C');


$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 10, 'Section 124(1), 126, 126A(4), 130(1) ', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'TRIAL SCHEDULE', 0, 1, 'C');


$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, '  PERSONAL DEAILS', 1, 1, 'L');
$pdf->ln(6);
$pdf->SetLeftMargin(20);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 8, 'NIC Number', 0, 0, 'L');
$pdf->Cell(40, 8, $data_1['nic'], 0, 1, 'L');

$pdf->Cell(40, 8, 'Full Name', 0, 0, 'L');
$pdf->Cell(40, 8, $data_1['full_name'], 0, 1, 'L');

$pdf->Cell(40, 8, 'Sex', 0, 0, 'L');
if ($data_1['gender'] == 1) {
    $pdf->Cell(40, 8, "Male", 0, 1, 'L');
} else if ($data_1['gender'] == 2) {
    $pdf->Cell(40, 8, "Female", 0, 1, 'L');
}

$pdf->Cell(40, 8, 'Date of Birth', 0, 0, 'L');
$pdf->Cell(40, 8, $data_2['dob'], 0, 1, 'L');


$pdf->Cell(40, 8, 'Permanant Address', 0, 0, 'L');
$pdf->Cell(40, 8, $data_2['address'], 0, 1, 'L');


$file_content = $data_2['user_photo'];
$name = $data_1['nic'] . '.jpg';
file_put_contents('C:/wamp64new/www/DLMS/Admin/permit_images' . '/' . $name, $file_content);

$filepath = 'C:/wamp64new/www/DLMS/Admin/permit_images' . '/' . $name;
$pdf->Image($filepath, 155, 65, 37, 45);
$pdf->SetLeftMargin(10);

$pdf->ln(12);

$pdf->SetFont('Arial', '', 9);

$pdf->MultiCell(0, 6, 'The holder of this License is subject to the provisions of the Section 125 of Motor Traffic Act Chapter 203 and is
hereby authorized to drive the classes of motor vehicle which corresponds with the
under mentioned classes subject to the limitations mentioned here.', 1, 'C');
$pdf->ln(8);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, '  WRITTEN TEST DETAILS', 1, 1, 'L');
$pdf->ln(6);
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(40, 8, 'Attempt', 0, 0, 'L');
$pdf->Cell(40, 8, $data_3['attempt'], 0, 1, 'L');

$pdf->Cell(40, 8, 'Result', 0, 0, 'L');
$pdf->Cell(40, 8, $data_3['result'], 0, 1, 'L');
$pdf->ln(8);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, '  TRIAL/PRACTICAL TEST DETAILS', 1, 1, 'L');

if ($data_2['A1'] ==1) {
    $pdf->Cell(0, 10, '  A1 : Light motor cycles Engine Capacity <100CC ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer   ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location1'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date1'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time1'], 0, 1, 'L');
}

if ($data_2['A'] ==1) {
    $pdf->Cell(0, 10, '  A : Motorcycles  Engine Capacity >=100CC ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       A1 : Light motor cycles Engine Capacity <100CC ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer  ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location1'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date1'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time1'], 0, 1, 'L');
}


if ($data_2['B1']==1) {
    $pdf->Cell(0, 10, '  B1 : Motor Tricycle or van Tare <500kg GVW <1000kg ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer   ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location2'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date2'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time2'], 0, 1, 'L');
}
if ($data_2['B'] ==1) {
    $pdf->Cell(0, 10, '  B : Dual purpose Motor vehicle GVW <3500kg Passengers<=8 Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer   ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location3'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date3'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time3'], 0, 1, 'L');
    
}
if ($data_2['C1'] ==1) {
    $pdf->Cell(0, 10, '  C1 : Light Motor Lorry  17000kg> GVW >=3500kg Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '       B : Dual purpose Motor vehicle GVW <3500kg Passengers<=8 Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer  ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location4'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date4'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time4'], 0, 1, 'L');
}
if ($data_2['C'] ==1) {
    $pdf->Cell(0, 10, '  C :  Motor Lorry  GVW >=1700kg Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '       C1 : Light Motor Lorry  17000kg> GVW >=3500kg Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '       B : Dual purpose Motor vehicle GVW <3500kg Passengers<=8 Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '       J : Special purpose Vehicle ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G : Agricultural Land Vehicle with or without a trailer  ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer   ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location4'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date4'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time4'], 0, 1, 'L');
}
if ($data_2['CE'] ==1) {
    $pdf->Cell(0, 10, '  CE : Heavy Motor Lorry GVW >=3500kg Trailer >750', 1, 1, 'L');
    $pdf->Cell(0, 10, '  C :  Motor Lorry  GVW >=1700kg Trailer <=750', 1, 1, 'L');

    $pdf->Cell(0, 10, '  C1 : Light Motor Lorry  17000kg> GVW >=3500kg Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '  B : Dual purpose Motor vehicle GVW <3500kg Passengers<=8 Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '  B1 : Motor Tricycle or van Tare <500kg GVW <1000kg ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  J : Special purpose Vehicle ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  G : Agricultural Land Vehicle with or without a trailer  ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer   ', 1, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location4'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date4'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time4'], 0, 1, 'L');
}
if ($data_2['D1'] ==1) {
    $pdf->Cell(0, 10, '  D1 : Light Motor Coach 32>=Passengers>=8 Tare <=750kg  ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  C1 : Light Motor Lorry  17000kg> GVW >=3500kg Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '  B : Dual purpose Motor vehicle GVW <3500kg Passengers<=8 Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '  B1 : Motor Tricycle or van Tare <500kg GVW <1000kg ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  G : Agricultural Land Vehicle with or without a trailer  ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer   ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location5'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date5'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time5'], 0, 1, 'L');
}

if ($data_2['D'] ==1) {
    $pdf->Cell(0, 10, '  D :  Motor Coach Passengers <=32 Tare <=750kg ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  D1 : Light Motor Coach 32>=Passengers>=8 Tare <=750kg  ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  C :  Motor Lorry  GVW >=1700kg Trailer <=750', 1, 1, 'L');

    $pdf->Cell(0, 10, '  C1 : Light Motor Lorry  17000kg> GVW >=3500kg Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '  B : Dual purpose Motor vehicle GVW <3500kg Passengers<=8 Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '  B1 : Motor Tricycle or van Tare <500kg GVW <1000kg ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  J : Special purpose Vehicle ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  G : Agricultural Land Vehicle with or without a trailer  ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer   ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location5'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date5'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time5'], 0, 1, 'L');
    
}
if ($data_2['DE'] ==1) {
    $pdf->Cell(0, 10, '  DE :  Heavy Motor Coach Passengers <=32 Tare >750kg C ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  D :  Motor Coach Passengers <=32 Tare <=750kg ', 1, 1, 'L');

    $pdf->Cell(0, 10, '  D1 : Light Motor Coach 32>=Passengers>=8 Tare <=750kg  ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  C :  Motor Lorry  GVW >=1700kg Trailer <=750', 1, 1, 'L');

    $pdf->Cell(0, 10, '  C1 : Light Motor Lorry  17000kg> GVW >=3500kg Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '  B : Dual purpose Motor vehicle GVW <3500kg Passengers<=8 Trailer <=750', 1, 1, 'L');
    $pdf->Cell(0, 10, '  B1 : Motor Tricycle or van Tare <500kg GVW <1000kg ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  J : Special purpose Vehicle ', 1, 1, 'L');
    $pdf->Cell(0, 10, '  G : Agricultural Land Vehicle with or without a trailer  ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer   ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location5'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date5'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time5'], 0, 1, 'L');
}
if ($data_2['G1'] ==1) {
    $pdf->Cell(0, 10, '  G1 : Two Wheel Tractor with a Trailer  ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location6'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date6'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time6'], 0, 1, 'L');
}

if ($data_2['G'] ==1) {
    $pdf->Cell(0, 10, '  G : Agricultural Land Vehicle with or without a trailer  ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 :Two Wheel Tractor with a Trailer  ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location6'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date    ', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date6'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time6'], 0, 1, 'L');
}

if ($data_2['J'] ==1) {
    $pdf->Cell(0, 10, '  J : Special purpose Vehicle ', 1, 1, 'L');
    $pdf->Cell(0, 10, '       G1 : Two Wheel Tractor with a Trailer ', 1, 1, 'L');
    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Location', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['location7'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Date', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['date7'], 0, 1, 'L');

    $pdf->Cell(80, 8, 'TRIAL/PRACTICAL Test Time', 0, 0, 'L');
    $pdf->Cell(40, 8, $data_5['time7'], 0, 1, 'L');
}




$pdf->ln(8);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, '  RECEIPT', 1, 1, 'L');
$pdf->ln(6);
$pdf->SetLeftMargin(20);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 8, 'Date of Issue', 0, 0, 'L');
$pdf->Cell(40, 8, date("Y/m/d"), 0, 0, 'L');

$pdf->Cell(40, 8, 'Issuing Officer', 0, 0, 'L');
$pdf->Cell(40, 8, $adata['admin_name'], 0, 1, 'L');




//$pdf->Output('my_file.pdf','I'); // Send to browser and display

$content = $pdf->Output("", "S"); //return the pdf file content as string
$db = mysqli_connect("localhost", "root", "", "dlms");

$sql = "INSERT INTO trial_slip(user_id,document) VALUES ($u_id,'" . addslashes($content) . "')";
$i = mysqli_query($db, $sql);

if ($i == true) {

    $success = 1;
    // $("#exampleModal1").modal('show');


}

ob_end_flush();
?>

<?php
require_once 'admin-header.php';
?>

<div class="right_col" role="main"></div>

<!-- footer content -->
<footer>
    <div class="pull-right">
        Driving License Management System
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>


    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-success">

                </div>
              
                <div class="modal-body">
                    Trial Details Document Uploaded Successfully
                </div>
                <div class="modal-footer">
                    <a href="Admin-Dashboard.php"><button type="button" class="btn btn-success">Ok</button></a>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-success">

                    <i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
              
                <div class="modal-body">
                    Upload Failed; Please Try Again
                </div>
                <div class="modal-footer">
                    <a href="Admin-Dashboard.php"><button type="button" class="btn btn-danger">Ok</button></a>

                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            var success = "<?php print($success); ?>";

            if (success == 1) {
                $('#myModal').modal('show');

            }
            else{
                $('#myModal2').modal('show');

            }

        });
    </script>


    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="Header/build/js/custom.min.js"></script>

</body>



</html>


