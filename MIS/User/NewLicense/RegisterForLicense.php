
<?php
require_once '../../includes/db.inc.php';
require_once 'newLicenseHeader.php';
$id = $_SESSION["userid"];
$A1 = $A = $B1 = $B = $C1 = $C = $CE = $D1 = $D = $DE = $G1 = $G =$J = '';  
$address = $province = $dob = '';  
$status=$condition=$feedback=$allset=$allset_status=$msg1=$msg2=$msg3=$msg4=$msg12=$msg22=$msg32=$msg42= '';   //initially the form is enabled
$_SESSION['update']=0;//new user 
$class = 0;
$_SESSION['amount']=0;
$_SESSION['Title']='Pay the required amount to complete the registration';
$askToPay="<li><a href='../Paypage/paypage.php'> Click here </a> to to pay the registration fee</li>";

//checking whether user already registered or not
$sql = "SELECT * FROM user_details WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) 
{
    $_SESSION['update']=1;//user exist
    $status = $row["status"];
    $feedback = $row["Description"];
    $address = $row["address"];
    $province = $row["province"];
    $dob = $row["dob"];

    //form condition
    if($status=='Pending')
    {
        $condition= 'disabled';
    }
    else if($status=='Rejected')
    {
        $condition= '';
    }
    if($status=='Approved')
    {
        $condition= 'disabled';
    }

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

    //check box condition
    if($row["A1"]==1)
    {
        $A1='checked';
    }
    if($row["A"]==1)
    {
        $A='checked';
    }
    if($row["B1"]==1)
    {
        $B1='checked';
    }
    if($row["B"]==1)
    {
        $B='checked';
    }
    if($row["C1"]==1)
    {
        $C1='checked';
    }
    if($row["C"]==1)
    {
        $C='checked';
    }
    if($row["CE"]==1)
    {
        $CE='checked';
    }
    if($row["D1"]==1)
    {
        $D1='checked';
    }
    if($row["D"]==1)
    {
        $D='checked';
    }
    if($row["DE"]==1)
    {
        $DE='checked';
    }
    if($row["G1"]==1)
    {
        $G1='checked';
    }
    if($row["G"]==1)
    {
        $G='checked';
    }
    if($row["J"]==1)
    {
        $J='checked';
    }

    //check document
    if( $row["nic_copy"]== NULL || $row["user_photo"]== NULL || $row["birth_certificate"]== NULL || $row["medical"]== NULL)
    {
        $allset= "Looks like you still haven't upload your: <br>";
    }
    if( $row["user_photo"]== NULL)
    {
        $msg1= "<li><a href='photo.php'>Photo</a></li>";
    }
    if( $row["birth_certificate"]== NULL)
    {
        $msg2="<li><a href='birthCertificate.php'>A copy of birth certificate</a></li>";
    }
    if( $row["medical"]== NULL)
    {
        $msg3="<li><a href='medical.php'>Medical</a></li>";
    }
    if( $row["nic_copy"]== NULL)
    {
        $msg4="<li><a href='NIC.php'>A copy of NIC</a></li>";
    }

    //Check document status
    if( $row["nic_status"]== 'Rejected' || $row["photo_status"]== 'Rejected' || $row["bc_status"]== 'Rejected' || $row["medical_status"]== 'Rejected')
    {
        $allset_status= "Looks like some of your files have been rejected. Please upload them again: <br>";
    }
    if( $row["photo_status"]== 'Rejected')
    {
        $msg12= "<li><a href='photo.php'>Photo</a></li>";
    }
    if( $row["bc_status"]== 'Rejected')
    {
        $msg22="<li><a href='birthCertificate.php'>A copy of birth certificate</a></li>";
    }
    if( $row["medical_status"]== 'Rejected')
    {
        $msg32="<li><a href='medical.php'>Medical</a></li>";
    }
    if( $row["nic_status"]=='Rejected')
    {
        $msg42="<li><a href='NIC.php'>A copy of NIC</a></li>";
    }

    

}

//check whether user paid or not
$sql = "SELECT * FROM written_payment WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) 
{
    if ($row['paid'] == 'No' && ($row['attempt'] == 2 || $row['attempt'] == 3))
    {
        $askToPay=""; //user paid registration fee
    }
    if ($row['paid'] == 'Yes')
    {
        $askToPay=""; //user paid registration fee
    }
}

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="container">

    <div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href="RegisterForLicense.php">Upload user information</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="photo.php">Upload photo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="birthCertificate.php">Upload a copy of birth certificate</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="medical.php">Upload medical certificate</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="NIC.php">Upload a copy of National Identity Card</a>
      </li>  
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">Fill in details to register</h5>
    <p class="card-text">
        <?php 
            if($allset_status != '')
            {
                echo "<div class= 'alert alert-warning'>
                    <strong>". $allset_status, $msg12, $msg22, $msg32, $msg42."</strong>
                </div>";
            }
            if($status == 'Pending')
            {
                echo "<div class= 'alert alert-info'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong> Your application is still processing. ". $allset, $msg1, $msg2, $msg3, $msg4."</strong>
                </div>";
            }
            if($status == 'Approved')
            {
                echo "<div class= 'alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Your application has been approved!
                <li><a href='activity.php'> Click here </a> to view your application</li>
                ".$askToPay."
                </strong>
                </div>";
                
            }
            if($status == 'Rejected')
            {
                echo "<div class= 'alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Your application has been rejected!<br> Admin Feedback: ".$feedback."</strong>
                </div>";
            }

            if (isset($_GET["error"])) {
                if ($_GET["error"] == "selectType") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong> You must select at least one license type</strong>
                    </div>";
                }
                if ($_GET["error"] == "stmtfailed") {
                    echo "<div class= 'alert alert-warning'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Cannot connect to the database! Please try again later</strong>
                    </div>";
                }
                if ($_GET["error"] == "none") {
                    echo "<div class= 'alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>User information was successfully submited!</strong>
                    </div>";
                }
                if ($_GET["error"] == "Updated") {
                    echo "<div class= 'alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>User information was successfully updated!</strong>
                    </div>";
                }
                if ($_GET["error"] == "RegistrationPaid") {
                    echo "<div class= 'alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Registration payment successfully updated! A confirmation email has been sent to your account.</strong>
                    </div>";
                }
            }
        ?>
    </p>
    <form class="form" action="RegisterForLicense.inc.php" method="post">
        <div class="form-group">
            <h6>Address</h6>
            <input type="text" class="form-control" name="address" placeholder="Enter Permanent address" required value="<?php echo $address?>"<?php echo $condition?>>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <h6>Province</h6>
                <select class="form-control" name="province" <?php echo $condition?> value="<?php echo $province?>">
                    <option value="Central Province">Central Province</option>
                    <option value="Eastern Province">Eastern Province</option>
                    <option value="North Central Province">North Central Province</option>
                    <option value="Northern Province">Northern Province</option>
                    <option value="North Western Province">North Western Province</option>
                    <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                    <option value="Southern Province">Southern Province</option>
                    <option value="Uva Province">Uva Province</option>
                    <option value="Western Province">Western Province</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <h6 translate="no">DOB</h6>
                <div class='input-group date' id='datetimepicker1'>
                    <input type="date" data-mdb-toggle="datepicker" class="form-control" name="dob" value="<?php echo $dob?>" required <?php echo $condition?>/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h6>Vehicle types you wish to apply license for<h6>
            <div class="form-group  d-flex justify-content-between">
                <ul class="list-group">
                    <li class="list-group-item">
                        <input type="checkbox" value="A1" name='A1' <?php echo $A1?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">A1: </span> Light motor cycles of which Engine Capacity does not exceeds 100CC
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="A" name='A' <?php echo $A?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">A: </span> Motorcycles of which Engine capacity exceeds 100CC
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="B1" name="B1" <?php echo $B1?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">B1: </span> Motor Tricycle or van of which tare does not exceed 500kg and Gross vehicle weight does not exceed 1000 kg
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="B" name="B" <?php echo $B?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">B: </span> Dual purpose Motor vehicle of which Gross Vehicle Weight does not exceed 3500kg and the seating capacity does not exceed 9 seats inclusive of the driver's seat, which may be combined with a trailer of which maximum authorized tare does not exceed 750kg
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="C1" name="C1"<?php echo $C1?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">C1: </span> Light Motor Lorry – Motor Lorry of which Gross Vehicle Weight exceeds 3500 kg and does not exceed 17000kg; Motor vehicles in this class may be combined with a trailer having maximum authorized tare which does not exceed 750kg, Motor vehicles of this class include a motor ambulance and motor hearses
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="C" name="C" <?php echo $C?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">C: </span> Motor Lorry of which Gross vehicle Weight is more than 17000kg, may be combine with a trailer having a maximum authorized tare which does not exceed 750kg
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="CE" name="CE"<?php echo $CE?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">CE: </span> Heavy Motor Lorry – Combination of motor lorry and trailer(s) including articulated vehicles and its trailer(s) of which maximum authorized tare of the trailer exceeds 750kg and gross vehicle weight exceeds 3500kg
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="D1" name="D1" <?php echo $D1?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">D1: </span> Light Motor Coach – Motor vehicles used for the carriage of persons and having seating capacity of not less than 9 seats and not more than 33 seats inclusive of the driver's seat; motor vehicle in this class may be combined with a trailer having a maximum authorized tare which does not exceed 750kg
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="D" name="D"<?php echo $D?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">D: </span> Motor Coach where the seating capacity does not exceed 33 seats inclusive of the driver's seat; motor vehicles in this class may be combined with a trailer having a maximum authorized tare which does not exceed 750kg
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="DE" name="DE" <?php echo $DE?> <?php echo $condition?>>&nbsp;&nbsp;
                       <span translate="no">DE: </span> Motor Coach – Combination of motor coach having a seating capacity of 33 seats inclusive of the driver's seat and its trailer having maximum authorized tare exceeding 750kg or a combination of two motor coaches
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="G1" name="G1"<?php echo $G1?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">G1: </span> Hand Tractors – Two Wheel Tractor with a Trailer
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="G" name="G" <?php echo $G?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">G: </span> Land Vehicle – Agricultural Land Vehicle with or without a trailer
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" value="J" name="J"<?php echo $J?> <?php echo $condition?>>&nbsp;&nbsp;
                        <span translate="no">J: </span> Special purpose Vehicle – Vehicle used for construction, loading & unloading excluding motor lorries, light motor lorries and heavy motor lorries, equipped with construction equipment and equipment for loading and unloading goods
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="form-group row justify-content-center">
            <button class="btn btn-success" input type="submit " name="submit" style="width: 20vw;" <?php echo $condition?>>Submit Form</button>                                
        </div>
    </form>
    
  </div>
</div>

    </div>
</div>
<?php
require_once 'footer.php';
?>