<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

$start_date_error = '';
$end_date_error = '';

if (isset($_POST["export"])) {


    $connect = mysqli_connect("localhost", "root", "", "dlms");

    $query ="SELECT * FROM  learners  WHERE  (date(learners.created_at) >= '" . $_POST["start_date"] . "' 
    AND date(learners.created_at) <= '" . $_POST["end_date"] . "' ) ORDER BY learners.created_at DESC ";

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


    if (mysqli_num_rows($result) > 0) {

        $sheet->setCellValue('A1', 'DETAILS OF REGISTERED DRIVING SCHOOLS : FROM "'. $_POST["start_date"] .'" TO "'. $_POST["end_date"] .'"');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A1:E1');

        $sheet->getStyle('A3:E3')->getFont()->setBold(true);

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
          


        $sheet->setCellValue('A3', 'Name');
        $sheet->setCellValue('B3', 'Address');
        $sheet->setCellValue('C3', 'Province');

        $sheet->setCellValue('D3', 'Contact Number');

        $sheet->setCellValue('E3', 'Joined On');
      

       


        $row = 4;
        while ($data = mysqli_fetch_assoc($result)) {
            $sheet->setCellValue('A' . $row, $data['learners_name']);
            $sheet->setCellValue('B' . $row, $data['learners_address']);

           

            $sheet->setCellValue('C' . $row, $data['learners_province']);

            $sheet->setCellValue('D' . $row, $data['learners_contact']);

            $sheet->setCellValue('E' . $row, $data['created_at']);
       

          


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
           
            $row++;
        }
    }



    $writer = new Xlsx($spreadsheet);
    $fileName = "Learners_Details.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
    ob_end_clean();

    $writer->save('php://output');
}
