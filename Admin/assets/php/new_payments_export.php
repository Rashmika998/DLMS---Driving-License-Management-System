<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;



if (isset($_POST["export"])) {


    $connect = mysqli_connect("localhost", "root", "", "dlms");

    $query = "SELECT * FROM  users INNER JOIN written_payment 
    ON users.user_id = written_payment.user_id  WHERE  written_payment.paid='Yes' AND (date(written_payment.paid_at) >= '" . $_POST["start_date"] . "' 
    AND date(written_payment.paid_at) <= '" . $_POST["end_date"] . "' ) ORDER BY written_payment.paid_at DESC";

    $result = mysqli_query($connect, $query);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);

    $sheet->getColumnDimension('E')->setAutoSize(true);


    if (mysqli_num_rows($result) > 0) {

        $sheet->setCellValue('A1', 'NEW LICENSE PAYMENT DETAILS : FROM "' . $_POST["start_date"] . '" TO "' . $_POST["end_date"] . '"');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A1:E1');

        $sheet->getStyle('A3:E3')->getFont()->setBold(true);

        $row = 3;
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




        $sheet->setCellValue('A3', 'Full Name');
        $sheet->setCellValue('B3', 'Amount (Rs.)');
        $sheet->setCellValue('C3', 'Paid On');
        $sheet->setCellValue('D3', 'Scheduled For Written Exam');
        $sheet->setCellValue('E3', 'Attempt');







        $row = 4;
        while ($data = mysqli_fetch_assoc($result)) {
            $sheet->setCellValue('A' . $row, $data['full_name']);
            $sheet->setCellValue('B' . $row, $data['amount']);

            $sheet->setCellValue('C' . $row, $data['paid_at']);
            $sheet->setCellValue('D' . $row, $data['scheduled']);
            $sheet->setCellValue('E' . $row, $data['attempt']);




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
    $fileName = "Written_Exam_Payments.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
    ob_end_clean();

    $writer->save('php://output');
}
