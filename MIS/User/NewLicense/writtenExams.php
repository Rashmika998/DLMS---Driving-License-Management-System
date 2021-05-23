<?php
//session_start();
require_once '../../includes/db.inc.php';
require_once 'newLicenseHeader.php';
$id = $_SESSION['userid'];
$ExamNotification ='<h6>No notifications to display</h6>';
$location = $date = $time =  $msg = $Examresult  ='';
$scheduled=0;
$class = 0;
$attempt = 'New user';
//written stat
$sql = "SELECT * FROM written_exam WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result))  
{
    $attempt = $row['attempt'];
    $location = $row['location'];
    $date = $row['date'];
    $time = $row['time'];
    $Examresult = $row['result'];
    
    if($row['result'] == "N/A")
    {
        $Examresult = 'Not Attempted';
    }
      
}

//checking whether user already registered or not
$sql = "SELECT * FROM user_details WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) 
{
    //counting no of classes
    if($row["A1"]==1 || $row["A"]==1)
    {
        $class++;
    }
    if($row["B1"]==1 || $row["B"]==1)
    {
        $class++;
    }
    if($row["C1"]==1 || $row["C"]==1 || $row["CE"]==1)
    {
        $class++;
    }
    if($row["D1"]==1 || $row["D"]==1 || $row["DE"]==1)
    {
        $class++;
    }
    if($row["G1"]==1 || $row["G"]==1)
    {
        $class++;
    }
    if($row["J"]==1)
    {
        $class++;
    }

    if($class==1)
    {
        $_SESSION['amount']= 1700;
    }
    if($class==2)
    {
        $_SESSION['amount']= 2000;
    }
    if($class>=3)
    {
        $_SESSION['amount']= 2250;
    }
}

//checking whether exam scheduled or not
$sql = "SELECT * FROM written_payment WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result))  
{
    if ($row['scheduled'] == 'Yes'){
        $scheduled = 1;
    }
}

if ($scheduled == 0)
{
    $msg = "<tr>
                <td><h6>Attempt - ".$attempt."<br>Your written exams aren't sheduled yet...</h6></td>
            </tr>";
}
if($scheduled == 1)
{
    $msg = "
        <tr>
        <td>Attempt</td>
        <td>:</td>
        <td>".$attempt."</td>
        </tr>

        <tr>
        <td>Location</td>
        <td>:</td>
        <td>".$location."</td>
        </tr>

        <tr>
        <td>Date</td>
        <td>:</td>
        <td>".$date."</td>
        </tr>

        <tr>
        <td>Time</td>
        <td>:</td>
        <td>".$time."</td>
        </tr>

        <tr>
        <td>Result</td>
        <td>:</td>
        <td>".$Examresult."</td>
        </tr>
    ";
}
if ($Examresult == 'Fail' && $attempt<3)
{
    $_SESSION['amount']=250;
    $ExamNotification ="<h4 class='text-danger'>You have failed your written exam.</h4>Please pay an additional amount of 250.00 LKR as the re-registration fee.
    <br><br><br><br>
    <div class='d-flex justify-content-center'>
    <a href='../Paypage/paypage.php' class='btn btn-primary'>Click To Pay ".$_SESSION['amount'].".00 LKR</a>
    </div>
    ";
}
if ($Examresult == 'Fail' && $attempt==3)
{
    $_SESSION['banned']='disabled'; 
    $ExamNotification ="<h4 class='text-danger'>You have failed your written exam in all 3 attempts!</h4>Please note that you can no longer apply for a Driver's License.";
}

if ($Examresult == 'Pass')
{
    $ExamNotification ='<h6>You have passed your written exam</h6>';
}

?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="container">
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                    Check Exam Stats 
                </button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse show">
                <div class="card-body">
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "stmtfailed") { ?>
                
                        <div class="alert alert-warning alert-dismissible text-center mt-2 m-0">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong> Cannot coonect to the database! Please try again later </strong>
                        </div>
                    <?php }
                            if ($_GET["error"] == "RegistrationPaid") { ?>
                            <div class="alert alert-success alert-dismissible text-center mt-2 m-0">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong> Payment Successfull! </strong>
                        </div>
                    <?php }
                            if ($_GET["error"] == "none") { ?>
                                <div class="alert alert-success alert-dismissible text-center mt-2 m-0">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong> Payment Successfull! </strong>
                            </div>
                        <?php } } ?> <br>
                        <div class='row'>
                        <div class='col-12 col-md-5'>
                            <table class='table'>
                                <thead class='table-info text-center'>
                                    <tr class='text-center'>
                                        <th class='text-center' colspan='3'>Exam Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $msg; ?>  
                                </tbody>
                            </table>
                        </div>

                        <div class='col-12 col-md-1'>
                        </div>

                        <div class='col-12 col-md-6'>
                                <table class='table'>
                                <thead class='table-info text-center'>
                                    <tr class='text-center'>
                                        <th class='text-center'>Exam Notifications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $ExamNotification; ?> </td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Study Material 
                </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse">
                <div class="card-body table-responsive">
                <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">File Name</th>
                <th scope="col">Download</th>

              </tr>
            </thead>

            <?php
            $con = mysqli_connect("localhost", "root", "", "dlms");

            $sql = "SELECT fileid , filename ,filetype FROM tbl_uploads";
            $result = mysqli_query($con, $sql);
              

            while ($row = mysqli_fetch_array($result)) {
            ?>
              <tr>
                <td><?php echo $row['fileid']; ?></td>
                <td><?php if ($row['filetype']=="application/pdf" ) {
                        echo   '<i class="fa fa-file-pdf-o" style="font-size:25px;color:red">'; echo '</i>';
                        echo   ' &nbsp'; 
                      }

                        else if($row['filetype']=="image/jpeg" || $row['filetype']=="image/png"){
                          echo   '<i class="fa fa-file-image-o" style="font-size:25px;color:black">'; echo '</i>';
                          echo   ' &nbsp'; 
                        }
                        
                          echo $row['filename'];

                        
                ?> 
                </td>
  

                <td><a href="download.php?id=<?php echo urlencode($row['fileid']); ?>"
                   ><?php $row['filename'];?><i class="fa fa-download"></i></a></td>
              </tr>
            <?php
            }
            ?>

          </table>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
require_once 'footer.php';
?>