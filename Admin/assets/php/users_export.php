<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;



if (isset($_POST["export_users"])) {


    $connect = mysqli_connect("localhost", "root", "", "dlms");

    $query ="SELECT * FROM  users  WHERE  (date(users.created_at) >= '" . $_POST["ustart_date"] . "' 
    AND date(users.created_at) <= '" . $_POST["uend_date"] . "' ) ORDER BY users.created_at DESC ";

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

        $sheet->setCellValue('A1', 'DETAILS OF REGISTERED USERS : FROM "'. $_POST["ustart_date"] .'" TO "'. $_POST["uend_date"] .'"' );
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A1:G1');

        $sheet->getStyle('A3:G3')->getFont()->setBold(true);

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
           


        $sheet->setCellValue('A3', 'Username');
        $sheet->setCellValue('B3', 'Full Name');
        $sheet->setCellValue('C3', 'Gender');

        $sheet->setCellValue('D3', 'Email Address');
        $sheet->setCellValue('E3', 'Contact Number');

        $sheet->setCellValue('F3', 'Joined On');
        $sheet->setCellValue('G3', 'Applied For');

       


        $row = 4;
        while ($data = mysqli_fetch_assoc($result)) {
            $sheet->setCellValue('A' . $row, $data['user_name']);
            $sheet->setCellValue('B' . $row, $data['full_name']);

            if($data['gender']==1){
                $sheet->setCellValue('C' . $row, "Male");

            }

            else if($data['gender']==2){
                $sheet->setCellValue('C' . $row, "Female");
            }

            else if($data['gender']==3){
                $sheet->setCellValue('C' . $row, "Other");
            }

            $sheet->setCellValue('D' . $row, $data['user_email']);

            $sheet->setCellValue('E' . $row, $data['contact_no']);

            $sheet->setCellValue('F' . $row, $data['created_at']);
            if($data['type']==null){
                $sheet->setCellValue('G' . $row, "-");
            }
            else{
            $sheet->setCellValue('G' . $row, $data['type']);
            }

          


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
          
            $row++;
        }
    }



    $writer = new Xlsx($spreadsheet);
    $fileName = "User_Details.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
    ob_end_clean();

    $writer->save('php://output');
}
