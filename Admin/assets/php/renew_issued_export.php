<?Php
require_once 'config.php';

$success = -1;
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


$query = "SELECT * FROM  users INNER JOIN user_details_renewal 
ON users.user_id = user_details_renewal.user_id  WHERE user_details_renewal.status='Approved' AND (date(user_details_renewal.Issued_date) >= '" . $_POST["start_date"] . "' 
AND date(user_details_renewal.Issued_date) <= '" . $_POST["end_date"] . "' ) AND Issuing_State=1 ORDER BY user_details_renewal.Issued_date DESC";

$result = mysqli_query($link, $query);

$pdf = new FPDF('p', 'mm', 'A4');
$pdf->AddPage();
$pdf->Rect(5, 5, 200, 287, 'D'); //For A4
$pdf->Image('emblem.png', 20, 10, 24, 35);
//$pdf->Image('logo.jpeg',150,20,54,16);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'DEPARTMENT OF MOTOR TRAFFIC', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Motor Traffic Act Chapter 203', 0, 1, 'C');

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 10, 'Section 124(1), 126, 126A(4), 130(1) ', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'NEW LICENSE RENEWALS', 0, 1, 'C');

$pdf->SetLeftMargin(65);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80, 10,'From '.$_POST["start_date"].' To '.$_POST["end_date"],0, 0, 'C');


$pdf->SetLeftMargin(0);

$pdf->SetFont('Arial', 'B', 11);
$pdf->ln(18);
$pdf->SetLeftMargin(25);



$pdf->SetFont('Arial', 'B', 11);
$pdf->ln(10);
$pdf->SetLeftMargin(25);

if (mysqli_num_rows($result) > 0) {


$pdf->Cell(80, 10, 'Full Name', 1, 0, 'C');
$pdf->Cell(80, 10, 'Issued On', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
while ($data = mysqli_fetch_assoc($result)) {
$pdf->Cell(80, 10, $data['full_name'] ,1, 0, 'C');
$pdf->Cell(80, 10,$data['Issued_date'] , 1, 1, 'C');
}
}

else{
    $pdf->SetLeftMargin(65);

    $pdf->Cell(80, 10, 'No data to be displayed', 0, 0, 'C');
}
$pdf->Output('my_file.pdf','I'); // Send to browser and display
