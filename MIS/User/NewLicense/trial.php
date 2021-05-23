<?php
//session_start();
require_once '../../includes/db.inc.php';
require_once 'newLicenseHeader.php';
$id = $_SESSION['userid'];
$A1 = $A = $B1 = $B = $C1 = $C = $CE = $D1 = $D = $DE = $G1 = $G =$J = '';
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="container">

        <div class="card-body table-responsive">
            <table class="table ">
            <thead>
                <tr>
                    <th colspan='6' style='text-align:center;'><h5>Practical Exam Details</h5></th>  
                </tr>
                <?php 
                    $sql = "SELECT * FROM trial_result WHERE user_id = $id;";
                    $_SESSION['trial'] = 0;
                    $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                    while ($row = mysqli_fetch_assoc($result))  
                        {
                            if($row['resultA1'] == 'Fail' && $row['attemptA1'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultA'] == 'Fail' && $row['attemptA'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultB1'] == 'Fail' && $row['attemptB1'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultB'] == 'Fail' && $row['attemptB'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultC1'] == 'Fail' && $row['attemptC1'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultC'] == 'Fail' && $row['attemptC'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultCE'] == 'Fail' && $row['attemptCE'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultD1'] == 'Fail' && $row['attemptD1'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultD'] == 'Fail' && $row['attemptD'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultDE'] == 'Fail' && $row['attemptDE'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultG1'] == 'Fail' && $row['attemptG1'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultG'] == 'Fail' && $row['attemptG'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            if($row['resultJ'] == 'Fail' && $row['attemptJ'] < 3)
                            {
                                $_SESSION['trial']++;
                            }
                            $_SESSION['trial'] = $_SESSION['trial'] * 500;
                            if( $_SESSION['trial'] > 0)
                            {
                                echo "
                                    <tr>
                                        <th colspan='6'>
                                            <div class='alert alert-danger'>
                                            <h6><li><a href='TrialPay.php' class='alert-link'>Click here</a> to re-apply to the failed practical exam(s). Your total reapplying fee is ".$_SESSION['trial'].".00 LKR</li></h6>
                                            </div>
                                        </th>
                                    </tr>
                                ";
                            }

                            if($row['resultA1'] == 'Fail' && $row['attemptA1'] == 3)
                            {
                                $A1=' A1 ';
                            }
                            if($row['resultA'] == 'Fail' && $row['attemptA'] == 3)
                            {
                                $A = ' A ';
                            }
                            if($row['resultB1'] == 'Fail' && $row['attemptB1'] == 3)
                            {
                                $B1=' B1 ';
                            }
                            if($row['resultB'] == 'Fail' && $row['attemptB'] == 3)
                            {
                                $B = ' B ';
                            }
                            if($row['resultC1'] == 'Fail' && $row['attemptC1'] == 3)
                            {
                                $C1 = ' C1 ';
                            }
                            if($row['resultC'] == 'Fail' && $row['attemptC'] == 3)
                            {
                                $C = ' C ';
                            }
                            if($row['resultCE'] == 'Fail' && $row['attemptCE'] == 3)
                            {
                                $CE = ' CE ';
                            }
                            if($row['resultD1'] == 'Fail' && $row['attemptD1'] == 3)
                            {
                                $D1=' D1 ';
                            }
                            if($row['resultD'] == 'Fail' && $row['attemptD'] == 3)
                            {
                                $D = ' D ';
                            }
                            if($row['resultDE'] == 'Fail' && $row['attemptDE'] == 3)
                            {
                                $DE = ' DE ';
                            }
                            if($row['resultG1'] == 'Fail' && $row['attemptG1'] == 3)
                            {
                                $G1 = ' G1 ';
                            }
                            if($row['resultG'] == 'Fail' && $row['attemptG'] == 3)
                            {
                                $G = ' G ';
                            }
                            if($row['resultJ'] == 'Fail' && $row['attemptJ'] == 3)
                            {
                                $J = ' J ';
                            }

                            if(
                            ($row['resultA1'] == 'Fail' && $row['attemptA1'] == 3) || 
                            ($row['resultA'] == 'Fail' && $row['attemptA'] == 3) || 
                            ($row['resultB1'] == 'Fail' && $row['attemptB1'] == 3) || 
                            ($row['resultB'] == 'Fail' && $row['attemptB'] == 3) || 
                            ($row['resultC1'] == 'Fail' && $row['attemptC1'] == 3) || 
                            ($row['resultC'] == 'Fail' && $row['attemptC'] == 3) || 
                            ($row['resultCE'] == 'Fail' && $row['attemptCE'] == 3) || 
                            ($row['resultD1'] == 'Fail' && $row['attemptD1'] == 3) || 
                            ($row['resultD'] == 'Fail' && $row['attemptD'] == 3) || 
                            ($row['resultDE'] == 'Fail' && $row['attemptDE'] == 3) || 
                            ($row['resultG1'] == 'Fail' && $row['attemptG1'] == 3) || 
                            ($row['resultG'] == 'Fail' && $row['attemptG'] == 3) ||
                            ($row['resultJ'] == 'Fail' && $row['attemptJ'] == 3)
                            )
                            {
                                echo "
                                    <tr>
                                        <th colspan='6'>
                                            <div class='alert alert-danger'>
                                            <h6>You've failed your practical exam(s) in all three attempts under following classes</h6>
                                            <span translate='no'>".$A1.$A.$B1.$B.$C1.$C.$CE.$D1.$D.$DE.$G1.$G.$J."</span><br>Please not that you're banned from re-applying
                                            for Driver's License under above classes.
                                            </div>
                                        </th>
                                    </tr>
                                ";

                            }
                        }

                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "stmtfailed") {
                                echo "
                                    <tr>
                                        <th colspan='6'>
                                            <div class='alert alert-warning'>
                                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                            <h6>Cannot connect to the database! Please try again later</h6>
                                            </div>
                                        </th>
                                    </tr>
                                ";
                            }
                            if ($_GET["error"] == "none") {
                                echo "
                                    <tr>
                                        <th colspan='6'>
                                            <div class='alert alert-success'>
                                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                            <h6>Payment Successfull!</h6>
                                            </div>
                                        </th>
                                    </tr>
                                ";
                            }
                        }


                ?>
            </thead>
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Location</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Results</th>
                        <th scope="col">Attempt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $trialUser = 0; // no entry yet
                        $check = 0; // no entry in the trial_result table
                        $sql = "SELECT * FROM trial_result WHERE user_id = $id;"; 
                        $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                        while ($row = mysqli_fetch_assoc($result))  
                        {
                            $check = 1;
                        }

                        $sql = "SELECT * FROM trial_exam WHERE user_id = $id;"; 
                        $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                        while ($row = mysqli_fetch_assoc($result))  
                        {
                            $trialUser = 1 ;
                        }

                        if($check == 1 && $trialUser == 1)
                        {
                            $sql = "SELECT * FROM trial_exam, trial_result, user_details WHERE trial_result.user_id = $id AND trial_exam.user_id = $id AND user_details.user_id = $id ;";
                            $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                            while ($row = mysqli_fetch_assoc($result))  
                            {
                                if ($row['A1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>A1</h6></td>";
                                            if($row['date1'] == '2000-01-01' || $row['date1'] == NULL || $row['date1'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptA1']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location1']."</td>
                                                    <td>".$row['date1']."</td>
                                                    <td>".$row['time1']."</td>";
                                                    
                                                    if ($row['resultA1']=='') {
                                                        echo "<td>Not available</td>
                                                        <td>".$row['attemptA1']."</td>";
                                                    }
                                                    else {
                                                        echo "<td>".$row['resultA1']."</td>
                                                        <td>".$row['attemptA1']."</td>";
                                                    }
                                            }
                                    echo "</tr>";

                                }
                                if ($row['A'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>A</h6></td>";
                                            if($row['date1'] == '2000-01-01' || $row['date1'] == NULL || $row['date1'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptA']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location1']."</td>
                                                    <td>".$row['date1']."</td>
                                                    <td>".$row['time1']."</td>";
                                                    
                                                    if ($row['resultA']=='') {
                                                        echo "<td>Not available</td>
                                                        <td>".$row['attemptA']."</td>";
                                                    }
                                                    else{
                                                        echo "<td>".$row['resultA']."</td>
                                                        <td>".$row['attemptA']."</td>";
                                                    }
                                            }
                                    echo "</tr>";

                                }
                                if ($row['B1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>B1</h6></td>";
                                            if($row['date2'] == '2000-01-01' || $row['date2'] == NULL || $row['date2'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptB1']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location2']."</td>
                                                    <td>".$row['date2']."</td>
                                                    <td>".$row['time2']."</td>";
                                                    
                                                    if ($row['resultB1']=='') {
                                                        echo "<td>Not available</td>
                                                        <td>".$row['attemptB1']."</td>";
                                                    }
                                                    else{
                                                        echo "<td>".$row['resultB1']."</td>
                                                        <td>".$row['attemptB1']."</td>";
                                                    }
                                            }
                                    echo "</tr>";

                                }
                                if ($row['B'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>B</h6></td>";
                                            if($row['date3'] == '2000-01-01' || $row['date3'] == NULL || $row['date3'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptB']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location3']."</td>
                                                    <td>".$row['date3']."</td>
                                                    <td>".$row['time3']."</td>";
                                                    
                                                    if ($row['resultB']=='') {
                                                        echo "<td>Not available</td>
                                                        <td>".$row['attemptB']."</td>";
                                                    }
                                                    else{
                                                        echo "<td>".$row['resultB']."</td>
                                                        <td>".$row['attemptB']."</td>";
                                                    }
                                            }
                                    echo "</tr>";

                                }
                                if ($row['C1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>C1</h6></td>";
                                            if($row['date4'] == '2000-01-01' || $row['date4'] == NULL || $row['date4'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptC1']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location4']."</td>
                                                    <td>".$row['date4']."</td>
                                                    <td>".$row['time4']."</td>";

                                                    if ($row['resultC1']=='') {
                                                        echo "<td>Not available</td>
                                                        <td>".$row['attemptC1']."</td>";
                                                    }
                                                    else{
                                                        echo "<td>".$row['resultC1']."</td>
                                                        <td>".$row['attemptC1']."</td>";
                                                    }
                                            }
                                    echo "</tr>";

                                }
                                if ($row['C'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>C</h6></td>";
                                            if($row['date4'] == '2000-01-01' || $row['date4'] == NULL || $row['date4'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptC']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location4']."</td>
                                                    <td>".$row['date4']."</td>
                                                    <td>".$row['time4']."</td>";
                                                if ($row['resultC']=='') {
                                                    echo "<td>Not available</td>
                                                    <td>".$row['attemptC']."</td>";
                                                }
                                                else{
                                                    echo "<td>".$row['resultC']."</td>
                                                    <td>".$row['attemptC']."</td>";
                                                } 
                                            }
                                    echo "</tr>";
                                }
                                if ($row['CE'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>CE</h6></td>";
                                            if($row['date4'] == '2000-01-01' || $row['date4'] == NULL || $row['date4'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptCE']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location4']."</td>
                                                    <td>".$row['date4']."</td>
                                                    <td>".$row['time4']."</td>";
                                                    if ($row['resultCE']=='') {
                                                        echo "<td>Not available</td>
                                                        <td>".$row['attemptCE']."</td>";
                                                    }
                                                    else{
                                                        echo "<td>".$row['resultCE']."</td>
                                                        <td>".$row['attemptCE']."</td>";
                                                    }
                                            }
                                    echo "</tr>";

                                }
                                if ($row['D1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>D1</h6></td>";
                                            if($row['date5'] == '2000-01-01' || $row['date5'] == NULL || $row['date5'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptD1']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location5']."</td>
                                                    <td>".$row['date5']."</td>
                                                    <td>".$row['time5']."</td>";

                                                    if ($row['resultD1']=='') {
                                                        echo "<td>Not available</td>
                                                        <td>".$row['attemptD1']."</td>";
                                                    }
                                                    else{
                                                        echo "<td>".$row['resultD1']."</td>
                                                        <td>".$row['attemptD1']."</td>";
                                                    }
                                            }
                                    echo "</tr>";

                                }
                                if ($row['D'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>D</h6></td>";
                                            if($row['date5'] == '2000-01-01' || $row['date5'] == NULL || $row['date5'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptD']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location5']."</td>
                                                    <td>".$row['date5']."</td>
                                                    <td>".$row['time5']."</td>";
                                                if ($row['resultD']=='') {
                                                    echo "<td>Not available</td>
                                                    <td>".$row['attemptD']."</td>";
                                                }
                                                else{
                                                    echo "<td>".$row['resultD']."</td>
                                                    <td>".$row['attemptD']."</td>";
                                                } 
                                            }
                                    echo "</tr>";
                                }
                                if ($row['DE'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>DE</h6></td>";
                                            if($row['date5'] == '2000-01-01' || $row['date5'] == NULL || $row['date5'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptDE']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location5']."</td>
                                                    <td>".$row['date5']."</td>
                                                    <td>".$row['time5']."</td>";
                                                    if ($row['resultDE']=='') {
                                                        echo "<td>Not available</td>
                                                        <td>".$row['attemptDE']."</td>";
                                                    }
                                                    else{
                                                        echo "<td>".$row['resultDE']."</td>
                                                        <td>".$row['attemptDE']."</td>";
                                                    }
                                            }
                                    echo "</tr>";

                                }
                                if ($row['G1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>G1</h6></td>";
                                            if($row['date6'] == '2000-01-01' || $row['date6'] == NULL || $row['date6'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptG1']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location6']."</td>
                                                    <td>".$row['date6']."</td>
                                                    <td>".$row['time6']."</td>";

                                                    if ($row['resultG1']=='') {
                                                        echo "<td>Not available</td>
                                                        <td>".$row['attemptG1']."</td>";
                                                    }
                                                    else{
                                                        echo "<td>".$row['resultG1']."</td>
                                                        <td>".$row['attemptG1']."</td>";
                                                    }
                                            }
                                    echo "</tr>";

                                }
                                if ($row['G'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>G</h6></td>";
                                            if($row['date6'] == '2000-01-01' || $row['date6'] == NULL || $row['date6'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptG']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location6']."</td>
                                                    <td>".$row['date6']."</td>
                                                    <td>".$row['time6']."</td>";
                                                if ($row['resultG']=='') {
                                                    echo "<td>Not available</td>
                                                    <td>".$row['attemptG']."</td>";
                                                }
                                                else{
                                                    echo "<td>".$row['resultG']."</td>
                                                    <td>".$row['attemptG']."</td>";
                                                } 
                                            }
                                    echo "</tr>";
                                }
                                if ($row['J'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>J</h6></td>";
                                            if($row['date7'] == '2000-01-01' || $row['date7'] == NULL || $row['date7'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>".$row['attemptJ']."</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location7']."</td>
                                                    <td>".$row['date7']."</td>
                                                    <td>".$row['time7']."</td>";
                                                if ($row['resultJ']=='') {
                                                    echo "<td>Not available</td>
                                                    <td>".$row['attemptJ']."</td>";
                                                }
                                                else{
                                                    echo "<td>".$row['resultJ']."</td>
                                                    <td>".$row['attemptJ']."</td>";
                                                } 
                                            }
                                    echo "</tr>";
                                }
                            }
                        }

                        if($check == 0 && $trialUser == 1)
                        {
                            $sql = "SELECT * FROM trial_exam, user_details WHERE  trial_exam.user_id = $id AND user_details.user_id = $id ;";
                            $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                            while ($row = mysqli_fetch_assoc($result))  
                            {
                                if ($row['A1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>A1</h6></td>";
                                            if($row['date1'] == '2000-01-01' || $row['date1'] == NULL || $row['date1'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location1']."</td>
                                                    <td>".$row['date1']."</td>
                                                    <td>".$row['time1']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";

                                }
                                if ($row['A'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>A</h6></td>";
                                            if($row['date1'] == '2000-01-01' || $row['date1'] == NULL || $row['date1'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location1']."</td>
                                                    <td>".$row['date1']."</td>
                                                    <td>".$row['time1']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";

                                }
                                if ($row['B1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>B1</h6></td>";
                                            if($row['date2'] == '2000-01-01' || $row['date2'] == NULL || $row['date2'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location2']."</td>
                                                    <td>".$row['date2']."</td>
                                                    <td>".$row['time2']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";

                                }
                                if ($row['B'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>B</h6></td>";
                                            if($row['date3'] == '2000-01-01' || $row['date3'] == NULL || $row['date3'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location3']."</td>
                                                    <td>".$row['date3']."</td>
                                                    <td>".$row['time3']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";

                                }
                                if ($row['C1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>C1</h6></td>";
                                            if($row['date4'] == '2000-01-01' || $row['date4'] == NULL || $row['date4'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location4']."</td>
                                                    <td>".$row['date4']."</td>
                                                    <td>".$row['time4']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";

                                }
                                if ($row['C'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>C</h6></td>";
                                            if($row['date4'] == '2000-01-01' || $row['date4'] == NULL || $row['date4'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location4']."</td>
                                                    <td>".$row['date4']."</td>
                                                    <td>".$row['time4']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";
                                }
                                if ($row['CE'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>CE</h6></td>";
                                            if($row['date4'] == '2000-01-01' || $row['date4'] == NULL || $row['date4'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location4']."</td>
                                                    <td>".$row['date4']."</td>
                                                    <td>".$row['time4']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";

                                }
                                if ($row['D1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>D1</h6></td>";
                                            if($row['date5'] == '2000-01-01' || $row['date5'] == NULL || $row['date5'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location5']."</td>
                                                    <td>".$row['date5']."</td>
                                                    <td>".$row['time5']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";

                                }
                                if ($row['D'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>D</h6></td>";
                                            if($row['date5'] == '2000-01-01' || $row['date5'] == NULL || $row['date5'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location5']."</td>
                                                    <td>".$row['date5']."</td>
                                                    <td>".$row['time5']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";
                                }
                                if ($row['DE'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>DE</h6></td>";
                                            if($row['date5'] == '2000-01-01' || $row['date5'] == NULL || $row['date5'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location5']."</td>
                                                    <td>".$row['date5']."</td>
                                                    <td>".$row['time5']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";

                                }
                                if ($row['G1'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>G1</h6></td>";
                                            if($row['date6'] == '2000-01-01' || $row['date6'] == NULL || $row['date6'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location6']."</td>
                                                    <td>".$row['date6']."</td>
                                                    <td>".$row['time6']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";

                                }
                                if ($row['G'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>G</h6></td>";
                                            if($row['date6'] == '2000-01-01' || $row['date6'] == NULL || $row['date6'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location6']."</td>
                                                    <td>".$row['date6']."</td>
                                                    <td>".$row['time6']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";
                                }
                                if ($row['J'] == 1)
                                {
                                    echo "<tr>
                                            <td><h6 translate='no'>J</h6></td>";
                                            if($row['date7'] == '2000-01-01' || $row['date7'] == NULL || $row['date7'] == '')
                                            {
                                                echo "
                                                    <td colspan='4' style='text-align:center;' class='text-info'><h6><i class='fa fa-exclamation-circle' aria-hidden='true'></i> Practical exam not sheduled yet</h6></td>
                                                    <td>1</td>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                    <td>".$row['location7']."</td>
                                                    <td>".$row['date7']."</td>
                                                    <td>".$row['time7']."</td>
                                                    <td>Not available</td>
                                                    <td>1</td>";
                                            }
                                    echo "</tr>";
                                }
                            }

                        }

                        if($trialUser == 0){
                            echo "
                                    <tr style='text-align:center;'>
                                        <th colspan='6' >
                                        Your practical exams aren't sheduled yet...
                                        </th>
                                    </tr>
                                ";
                        }

                        
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php
require_once 'footer.php';
?>