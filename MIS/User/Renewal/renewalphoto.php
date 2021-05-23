<?php
require_once '../../includes/db.inc.php';
require_once 'renewalHeader.php';
$id = $_SESSION["userid"];
$Appstatus=$allset=$msg1=$msg2=$msg3='';   //initially the form is enabled
$_SESSION['update']=0;//new user 
$askToPay="<li><a href='../Paypage/paypage.php'> Click here </a> to to pay the registration fee</li>";
$status='new';
//checking whether user already registered or not
$sql = "SELECT * FROM user_details_renewal WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) 
{
    $_SESSION['update']=1;
    $status=$row["photo_status"];
    $Appstatus = $row["status"];
    if ($status==NULL){//no photo
        $condition=''; 
    }

    if ($status=='Pending'){ //photo uploaded
        $condition = 'disabled';
    };  
    if ($status=='Rejected'){ //rejected
        $condition='';
    }; 
    if ($status=='Approved'){ //approved
        $condition = 'disabled';
    };   
    
    
}

if($_SESSION['update']==0){
    $condition = 'disabled'; 
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

<link href="../../sss/css/StudyUpload.css" rel="stylesheet">
<!-- page content -->
<div class="right_col" role="main">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="RenewalRegistration.php">Upload user information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="renewalphoto.php">Upload user photo</a>
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
                <h5 class="card-title">Upload your photo here </h5>
                <p class="card-text">
                <?php
                        if($_SESSION['update']==0)
                        {
                            echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>This form is disabled! Please submit the user information form first.</strong>
                            </div>";
                        }
                        if($status == NULL)
                        {
                            echo "<div class= 'alert alert-warning'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Please upload a clear photo of your face to complete this step</strong>
                            </div>";
                            $condition='';
                        }
                        if($status == 'Pending')
                        {
                            echo "<div class= 'alert alert-info'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>This form is disabled, You have successfully uploaded your photo!<br>".$allset,$msg1,$msg2,$msg3."</strong>
                            </div>";
                        }
                        if($status == 'Rejected')
                        {
                            echo "<div class= 'alert alert-danger'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Your Photo has been rejected! Please upload a clear photo of your face again to complete this step</strong>
                            </div>";
                        }
                        if($Appstatus == 'Approved')
                        {
                            echo "<div class= 'alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Your application has been approved!
                                <li><a href='renewalactivitylog.php'> Click here </a> to view your application</li>
                                ".$askToPay."
                                </strong>
                            </div>";
                        }
                        else if($status == 'Approved')
                        {
                            echo "<div class= 'alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>This form is disabled, Your photo has been approved!</strong>
                            </div>";
                        }
                ?>
                    Photo requirements:
                    <ul>
                        <li>Upload a clear<strong> photo</strong> of your face. Do not use filters commonly used on social media.</li>
                        <li>Have someone else take your photo. No selfies.</li>
                        <li>Take off your eyeglasses for your photo.</li>
                        <li>Use a plain white or off-white background.</li>
                        <li>Should directly face the camera. No angled photos and both ears should be visible.</li>
                    </ul>
                </p>
                <form class="uploader" action="renewalphoto.inc.php" method="post" enctype="multipart/form-data" >
                <?php 
                    if($condition == 'disabled')
                    {
                        echo "<fieldset disabled>";
                    }
                ?>
                    
                    <label for="file-upload" class="outer" >
                        <img id="file-image" src="#" alt="Preview" class="hidden">
                        
                        <div id="start">
                            <label for ="select" >
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <div>Select a file</div>
                            </label>
                            <input type='file' id="select" style="display:none" name="file">
                        </div>

                        <div>
                            <p id="chosenfile"></p>
                            <button type="submit" name="btn-upload" class="btn btn-success">Upload</button>
                        </div>

                    </label>
                    <?php 
                    if($condition == 'disabled')
                    {
                        echo "</fieldset>";
                    }
                ?>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
  var input = document.getElementById('select');
  var infoArea = document.getElementById('chosenfile');

  input.addEventListener('change',showFileName);

  function showFileName(event){
    var input = event.srcElement;
    var fileName = input.files[0].name;
    infoArea.textContent = 'Selected File: ' + fileName;
  }
</script>
<?php
require_once 'footer.php';
?>
