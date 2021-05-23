<?php
require_once 'admin-header.php'; 

?>

<?php



// Set your timezone
date_default_timezone_set('Asia/Colombo');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y / m', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
    $date = $ym . '-' . $day;
     
    if ($today == $date) {
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
        $week = '';
    }

}
?>

<link rel="stylesheet" href="../css/calender.css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">


<div class="right_col" role="main">

    <!-- Add Admin -->
    <div class="row justify-content-center wrapper">
        <div class="col-lg-7 bg-white p-4">
            <h3 class="text-center font-weight-bold">Exam Schedule</h3>
            <hr class="my-3" />
            <div class="container px-4">
                <div class="row gx-5">
                    <div class="col">
                        <div class="p-3 border bg-light" style="height: 300px;">
                            <div class="row justify-content-center">
                                <div style="padding-top: 100px;">
                                    <a style="margin:auto;" href="#">
                                        <div class="row justify-content-center">
                                            <h5 style="text-align: center;">Previously Scheduled</h5>
                                        </div>
                                        <div class="row justify-content-center">
                                            <i class="fa fa-calendar-check-o fa-4x " aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3 border bg-light" style="height: 300px;">
                            <div class="row justify-content-center">
                                <div style="padding-top: 100px;">
                                    <a style="margin:auto;" href="#">
                                        <div class="row justify-content-center">
                                            <h5 style="text-align: center;">Add New Schedule</h5>
                                        </div>
                                        <div class="row justify-content-center">
                                            <i class="fa fa-calendar-plus-o fa-4x" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                
                    
                    <div class="container1">
            <h3 style="font-size: 120%;"><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
            <table class="table table-bordered">
                <tr>
                    <th>S</th>
                    <th>M</th>
                    <th>T</th>
                    <th>W</th>
                    <th>T</th>
                    <th>F</th>
                    <th>S</th>
                </tr>
                <?php
                    foreach ($weeks as $week) {
                        echo $week;
                    }
                ?>
            </table>
        </div>


                
             

            </div>  
                   
        </div>
    </div>
</div>

<?php

require_once 'admin-footer.php'; 

?>