<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;



if (isset($_POST["export"])) {


    $connect = mysqli_connect("localhost", "root", "", "dlms");

    $query = "SELECT * FROM  users INNER JOIN user_details 
    ON users.user_id = user_details.user_id  WHERE user_details.status='Rejected' AND (date(user_details.created_at) >= '" . $_POST["start_date"] . "' 
    AND date(user_details.created_at) <= '" . $_POST["end_date"] . "' ) ORDER BY user_details.created_at DESC ";

    $result = mysqli_query($connect, $query);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);
    $sheet->getColumnDimension('J')->setAutoSize(true);
    $sheet->getColumnDimension('K')->setAutoSize(true);
    $sheet->getColumnDimension('L')->setAutoSize(true);
    $sheet->getColumnDimension('M')->setAutoSize(true);
    $sheet->getColumnDimension('N')->setAutoSize(true);
    $sheet->getColumnDimension('O')->setAutoSize(true);
    $sheet->getColumnDimension('P')->setAutoSize(true);
    $sheet->getColumnDimension('Q')->setAutoSize(true);
    $sheet->getColumnDimension('R')->setAutoSize(true);
    $sheet->getColumnDimension('S')->setAutoSize(true);
    $sheet->getColumnDimension('T')->setAutoSize(true);



    if (mysqli_num_rows($result) > 0) {

        $sheet->setCellValue('A1', 'REJECTED NEW LICENSE APPLICATIONS : FROM "'. $_POST["start_date"] .'" TO "'. $_POST["end_date"] .'"');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A1:T1');

        $sheet->getStyle('A3:T3')->getFont()->setBold(true);

$row=3;
        $sheet->getStyle('A' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));


            $sheet->getStyle('B' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));

            $sheet->getStyle('C' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));

            $sheet->getStyle('D' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));

            $sheet->getStyle('E' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('F' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
                $sheet->getStyle('G' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('H' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('I' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('J' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('K' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('L' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('M' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('A' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('N' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('O' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('P' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('Q' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('R' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('S' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));

                $sheet->getStyle('T' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
           


        $sheet->setCellValue('A3', 'Full Name');
        $sheet->setCellValue('B3', 'Address');
        $sheet->setCellValue('C3', 'Province');

        $sheet->setCellValue('D3', 'Date of Birth');
        $sheet->setCellValue('E3', 'A1');
        $sheet->setCellValue('F3', 'A');
        $sheet->setCellValue('G3', 'B1');
        $sheet->setCellValue('H3', 'B');
        $sheet->setCellValue('I3', 'C1');
        $sheet->setCellValue('J3', 'C');
        $sheet->setCellValue('K3', 'CE');
        $sheet->setCellValue('L3', 'D1');
        $sheet->setCellValue('M3', 'D');
        $sheet->setCellValue('N3', 'DE');
        $sheet->setCellValue('O3', 'G1');
        $sheet->setCellValue('P3', 'G');
        $sheet->setCellValue('Q3', 'J');
        $sheet->setCellValue('R3', 'Status');
        $sheet->setCellValue('S3', 'Rejected On');
        $sheet->setCellValue('T3', 'Reason for Rejection');

       


        $row = 4;
        while ($data = mysqli_fetch_assoc($result)) {
            $sheet->setCellValue('A' . $row, $data['full_name']);
            $sheet->setCellValue('B' . $row, $data['address']);

            $sheet->setCellValue('C' . $row, $data['province']);

            $sheet->setCellValue('D' . $row, $data['dob']);

            if($data['A1']==null){
                $sheet->setCellValue('E' . $row, '-');
            }
            else{
                $sheet->setCellValue('E' . $row, $data['A1']);
            }
       
            if($data['A']==null){
                $sheet->setCellValue('F' . $row, '-');
            }
            else{
                $sheet->setCellValue('F' . $row, $data['A']);
            }
          
            if($data['B1']==null){
                $sheet->setCellValue('G' . $row, '-');
            }
            else{
                $sheet->setCellValue('G' . $row, $data['B1']);

            } if($data['B']==null){
                $sheet->setCellValue('H' . $row, '-');
            }
            else{
                $sheet->setCellValue('H' . $row, $data['B']);
            } if($data['C1']==null){
                $sheet->setCellValue('I' . $row, '-');
            }
            else{
                $sheet->setCellValue('I' . $row, $data['C1']);
            } if($data['C']==null){
                $sheet->setCellValue('J' . $row, '-');
            }
            else{
                $sheet->setCellValue('J' . $row, $data['C']);
            } if($data['CE']==null){
                $sheet->setCellValue('K' . $row, '-');
            }
            else{
                $sheet->setCellValue('K' . $row, $data['CE']);
            } if($data['D1']==null){
                $sheet->setCellValue('L' . $row, '-');
            }
            else{
                $sheet->setCellValue('L' . $row, $data['D1']);
            } if($data['D']==null){
                $sheet->setCellValue('M' . $row, '-');
            }
            else{
                $sheet->setCellValue('M' . $row, $data['D']);
            } if($data['DE']==null){
                $sheet->setCellValue('N' . $row, '-');
            }
            else{
                $sheet->setCellValue('N' . $row, $data['DE']);
            } if($data['G1']==null){
                $sheet->setCellValue('O' . $row, '-');
            }
            else{
                $sheet->setCellValue('O' . $row, $data['G1']);
            }

            if($data['G']==null){
                $sheet->setCellValue('P' . $row, '-');
            }
            else{
                $sheet->setCellValue('P' . $row, $data['G']);
            }

            if($data['J']==null){
                $sheet->setCellValue('Q' . $row, '-');
            }
            else{
                $sheet->setCellValue('Q' . $row, $data['J']);
            }

         
            $sheet->setCellValue('R' . $row, $data['status']);
            $sheet->setCellValue('S' . $row, $data['created_at']);
            $sheet->setCellValue('T' . $row, $data['Description']);

          


          


            $sheet->getStyle('A' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));


            $sheet->getStyle('B' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $sheet->getStyle('C' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $sheet->getStyle('D' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $sheet->getStyle('E' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('F' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));

                $sheet->getStyle('G' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('H' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('I' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('J' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('K' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('L' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('M' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('T' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('N' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('O' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('P' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('Q' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('R' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('S' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
          
            $row++;
        }
    }



    $writer = new Xlsx($spreadsheet);
    $fileName = "Rejected_New_License_Applications.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
    ob_end_clean();

    $writer->save('php://output');
}
