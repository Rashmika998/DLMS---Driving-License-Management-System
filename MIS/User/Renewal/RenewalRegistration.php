
<?php
require_once '../../includes/db.inc.php';
require_once 'renewalHeader.php';
$id = $_SESSION["userid"];
$address = $province = $dob = '';  
$status=$condition=$feedback=$allset=$allset_status=$msg1=$msg2=$msg3=$msg4=$msg12=$msg22=$msg32=$msg42= '';   //initially the form is enabled
$_SESSION['update']=0;//new user 
$_SESSION['amount']=500;
$_SESSION['Title']='Pay the required amount to complete the renewal';
$askToPay="<li><a href='../Paypage/renewalpaypage.php'> Click here </a> to pay the renewal fee</li>";



if( mysqli_query($link, "SELECT * FROM user_details_renewal WHERE user_id = $id")){
    $sql = "SELECT * FROM user_details_renewal WHERE user_id = $id";
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

   
    //check document
    if( $row["user_photo"]== NULL || $row["previous_license"]== NULL || $row["medical"]== NULL)
    {
        $allset= "Looks like you still haven't uploaded your: <br>";
    }
    if( $row["user_photo"]== NULL)
    {
        $msg1= "<li><a href='renewalphoto.php'>Photo</a></li>";
    }
    if( $row["previous_license"]== NULL)
    {
        $msg2="<li><a href='renewalprevlicense.php'>Previous license</a></li>";
    }
    if( $row["medical"]== NULL)
    {
        $msg3="<li><a href='renewalmedical.php'>Medical</a></li>";
    }
    

    //Check document status
    if( $row["photo_status"]== 'Rejected' || $row["license_status"]== 'Rejected' || $row["medical_status"]== 'Rejected')
    {
        $allset_status= "Looks like some of your files have been rejected. Please upload them again: <br>";
    }
    if( $row["photo_status"]== 'Rejected')
    {
        $msg12= "<li><a href='renewalphoto.php'>Photo</a></li>";
    }
    if( $row["license_status"]== 'Rejected')
    {
        $msg22="<li><a href='renewalprevlicense.php'>A copy of previous license</a></li>";
    }
    if( $row["medical_status"]== 'Rejected')
    {
        $msg32="<li><a href='renewalmedical.php'>Medical</a></li>";
    }
       

}
}
else{
    $status ="";
    $feedback = "";
    $address = "";
    $province = "";
    $dob = "";

}

//check whether user paid or not
$sql = "SELECT * FROM renewal_payment WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) 
{
    if ($row['amount'] == 500 && ($row['paid'] == 'Yes' ))
    {
        $askToPay="";//user paid registration fee
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
        <a class="nav-link active" aria-current="true" href="RenewalRegistration.php">Upload user information</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="renewalphoto.php">Upload user photo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="renewalprevlicense.php">Upload a pdf of previous license</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="renewalmedical.php">Upload medical</a>
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
                    <strong>". $allset_status, $msg12, $msg22, $msg32."</strong>
                </div>";
            }
            if($status == 'Pending')
            {
                echo "<div class= 'alert alert-info'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong> Your application is still processing. ". $allset, $msg1, $msg2, $msg3."</strong>
                </div>";
            }
            if($status == 'Approved')
            {
                echo "<div class= 'alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Your application has been approved!
                <li><a href='renewalactivitylog.php'> Click here </a> to view your application</li>
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
                if ($_GET["error"] == "RenewalPaid") {
                    echo "<div class= 'alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Renewal payment successfully updated! A confirmation email has been sent to your account.</strong>
                    </div>";
                }
            }
        ?>
    </p>
    <form class="form" action="RenewalRegistration.inc.php" method="post">
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
                <h6 translate=no>DOB</h6>
                <div class='input-group date' id='datetimepicker1'>
                    <input type="date" data-mdb-toggle="datepicker" class="form-control" name="dob" value="<?php echo $dob?>" required <?php echo $condition?>/>
                </div>
            </div>
        </div>
     
        <br>
        <div class="form-group row justify-content-center">
            <button class="btn btn-success" input type="submit " name="submit" style="width: 30vw;" <?php echo $condition?>>Submit Form</button>                                
        </div>
    </form>
    
  </div>
</div>

    </div>
</div>
<?php
require_once 'footer.php';
?>