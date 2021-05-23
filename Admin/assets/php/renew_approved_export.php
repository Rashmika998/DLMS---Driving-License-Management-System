<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;



if (isset($_POST["export"])) {


    $connect = mysqli_connect("localhost", "root", "", "dlms");

    $query = "SELECT * FROM  users INNER JOIN user_details_renewal 
    ON users.user_id = user_details_renewal.user_id  WHERE user_details_renewal.status='Approved' AND (date(user_details_renewal.created_at) >= '" . $_POST["start_date"] . "' 
    AND date(user_details_renewal.created_at) <= '" . $_POST["end_date"] . "' ) ORDER BY user_details_renewal.created_at DESC";

    $result = mysqli_query($connect, $query);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
 



    if (mysqli_num_rows($result) > 0) {

        $sheet->setCellValue('A1', 'APPROVED LICENSE RENEWAL APPLICATIONS : FROM "'. $_POST["start_date"] .'" TO "'. $_POST["end_date"] .'"');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A1:C1');

        $sheet->getStyle('A3:C3')->getFont()->setBold(true);

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

           


        $sheet->setCellValue('A3', 'Full Name');
        $sheet->setCellValue('B3', 'Status');
        $sheet->setCellValue('C3', 'Approved On');

     

       


        $row = 4;
        while ($data = mysqli_fetch_assoc($result)) {
            $sheet->setCellValue('A' . $row, $data['full_name']);
            $sheet->setCellValue('B' . $row, $data['status']);

            $sheet->setCellValue('C' . $row, $data['created_at']);

            

    
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

           
          
            $row++;
        }
    }



    $writer = new Xlsx($spreadsheet);
    $fileName = "Approved_Renewal_Applications.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
    ob_end_clean();

    $writer->save('php://output');
}
