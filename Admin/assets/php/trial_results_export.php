<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

if (isset($_POST["export"])) {


    $connect = mysqli_connect("localhost", "root", "", "dlms");

    $query = "SELECT * FROM  users INNER JOIN trial_result 
ON trial_result.user_id= users.user_id ORDER BY trial_result.user_id DESC";

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
    $sheet->getColumnDimension('U')->setAutoSize(true);
    $sheet->getColumnDimension('V')->setAutoSize(true);
    $sheet->getColumnDimension('W')->setAutoSize(true);
    $sheet->getColumnDimension('X')->setAutoSize(true);
    $sheet->getColumnDimension('Y')->setAutoSize(true);
    $sheet->getColumnDimension('Z')->setAutoSize(true);
    $sheet->getColumnDimension('AA')->setAutoSize(true);





    if (mysqli_num_rows($result) > 0) {

        $sheet->setCellValue('A1', 'TRIAL EXAM RESULTS');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A1:AA1');

        $sheet->getStyle('A3:AA3')->getFont()->setBold(true);

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
            $sheet->getStyle('U' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('V' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('W' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('X' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('Y' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));
            $sheet->getStyle('Z' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));

            $sheet->getStyle('AA' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_MEDIUM)
                ->setColor(new Color('000000'));


        $sheet->setCellValue('A3', 'Full Name');
        $sheet->setCellValue('B3', 'Attempt_A1');
        $sheet->setCellValue('C3', 'Result_A1');

        $sheet->setCellValue('D3', 'Attempt_A');
        $sheet->setCellValue('E3', 'Result_A');

        $sheet->setCellValue('F3', 'Attempt_B1');
        $sheet->setCellValue('G3', 'Result_B1');

        $sheet->setCellValue('H3', 'Attempt_B');
        $sheet->setCellValue('I3', 'Result_B');

        $sheet->setCellValue('J3', 'Attempt_C1');
        $sheet->setCellValue('K3', 'Result_C1');

        $sheet->setCellValue('L3', 'Attempt_C');
        $sheet->setCellValue('M3', 'Result_C');

        $sheet->setCellValue('N3', 'Attempt_CE');
        $sheet->setCellValue('O3', 'Result_CE');

        $sheet->setCellValue('P3', 'Attempt_D1');
        $sheet->setCellValue('Q3', 'Result_D1');

        $sheet->setCellValue('R3', 'Attempt_D');
        $sheet->setCellValue('S3', 'Result_D');

        $sheet->setCellValue('T3', 'Attempt_DE');
        $sheet->setCellValue('U3', 'Result_DE');

        $sheet->setCellValue('V3', 'Attempt_G1');
        $sheet->setCellValue('W3', 'Result_G1');

        $sheet->setCellValue('X3', 'Attempt_G');
        $sheet->setCellValue('Y3', 'Result_G');

        $sheet->setCellValue('Z3', 'Attempt_J');
        $sheet->setCellValue('AA3', 'Result_J');



        $row = 4;
        while ($data = mysqli_fetch_assoc($result)) {
            $sheet->setCellValue('A' . $row, $data['full_name']);

            $sheet->setCellValue('B' . $row, $data['attemptA1']);
            if ($data['resultA1'] == null) {
                $sheet->setCellValue('C' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('C' . $row, $data['resultA1']);
            }

            $sheet->setCellValue('D' . $row, $data['attemptA']);
            if ($data['resultA'] == null) {
                $sheet->setCellValue('E' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('E' . $row, $data['resultA']);
            }

            $sheet->setCellValue('F' . $row, $data['attemptB1']);
            if ($data['resultB1'] == null) {
                $sheet->setCellValue('G' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('G' . $row, $data['resultB1']);
            }

            $sheet->setCellValue('H' . $row, $data['attemptB']);
            if ($data['resultB'] == null) {
                $sheet->setCellValue('I' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('I' . $row, $data['resultB']);
            }

            $sheet->setCellValue('J' . $row, $data['attemptC1']);
            if ($data['resultC1'] == null) {
                $sheet->setCellValue('K' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('K' . $row, $data['resultC1']);
            }
            $sheet->setCellValue('L' . $row, $data['attemptC']);
            if ($data['resultC'] == null) {
                $sheet->setCellValue('M' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('M' . $row, $data['resultC']);
            }
            $sheet->setCellValue('N' . $row, $data['attemptCE']);
            if ($data['resultCE'] == null) {
                $sheet->setCellValue('O' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('O' . $row, $data['resultCE']);
            }
            $sheet->setCellValue('P' . $row, $data['attemptD1']);
            if ($data['resultD1'] == null) {
                $sheet->setCellValue('Q' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('Q' . $row, $data['resultD1']);
            }
            $sheet->setCellValue('R' . $row, $data['attemptD']);
            if ($data['resultD'] == null) {
                $sheet->setCellValue('S' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('S' . $row, $data['resultD']);
            }
            $sheet->setCellValue('T' . $row, $data['attemptDE']);
            if ($data['resultDE'] == null) {
                $sheet->setCellValue('U' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('U' . $row, $data['resultDE']);
            }
            $sheet->setCellValue('V' . $row, $data['attemptG1']);
            if ($data['resultG1'] == null) {
                $sheet->setCellValue('W' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('W' . $row, $data['resultG1']);
            }
            $sheet->setCellValue('X' . $row, $data['attemptG']);
            if ($data['resultG'] == null) {
                $sheet->setCellValue('Y' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('Y' . $row, $data['resultG']);
            }
            $sheet->setCellValue('Z' . $row, $data['attemptJ']);
            if ($data['resultJ'] == null) {
                $sheet->setCellValue('AA' . $row, "Not Applied");
            } else {
                $sheet->setCellValue('AA' . $row, $data['resultJ']);
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
            $sheet->getStyle('A' . $row)
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
            $sheet->getStyle('T' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('U' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('V' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('W' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('X' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('Y' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $sheet->getStyle('Z' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $sheet->getStyle('AA' . $row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $row++;
        }
    }



    $writer = new Xlsx($spreadsheet);
    $fileName = "Trial_Results.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
    ob_end_clean();

    $writer->save('php://output');
}
