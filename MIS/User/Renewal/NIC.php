<?php
require_once '../../includes/db.inc.php';
require_once 'newLicenseHeader.php';
$id = $_SESSION["userid"];
$condition=$Appstatus=$allset=$msg1=$msg2=$msg3='';   //initially the form is enabled
$_SESSION['update']=0;//new user 
$askToPay="<li><a href='../Paypage/paypage.php'> Click here </a> to to pay the registration fee</li>";
$status='new';
//checking whether user already registered or not
$sql = "SELECT * FROM user_details WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) 
{
    $_SESSION['update']=1;
    $status=$row["nic_status"];
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
    
    //check document status
    if( $row["medical"]== NULL  || $row["user_photo"]== NULL || $row["birth_certificate"]== NULL)
    {
        $allset= "Looks like you still haven't upload your: <br>";
    }
    if( $row["user_photo"]== NULL)
    {
        $msg1= "<li><a href='photo.php'>Photo</a></li>";
    }
    if( $row["medical"]== NULL)
    {
        $msg2="<li><a href='medical.php'>Medical</a></li>";
    }
    if( $row["birth_certificate"]== NULL)
    {
        $msg3="<li><a href='birthCertificate.php'>A copy of birth certificate</a></li>";
    }
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
                    <a class="nav-link" aria-current="true" href="RegisterForLicense.php">Upload user information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photo.php">Upload photo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="birthCertificate.php">Upload a copy of birth certificate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="medical.php">Upload medical</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  active" href="NIC.php">Upload a copy of NIC</a>
                </li>  
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">Upload a copy of your NIC here</h5>
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
                            echo "<div class= 'alert alert-info'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Please upload a copy of your NIC to complete this step</strong>
                            </div>";
                            $condition='';
                        }
                        if($status == 'Pending')
                        {
                            echo "<div class= 'alert alert-info'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>This form is disabled, You have successfully uploaded a copy of your NIC!<br>".$allset,$msg1,$msg2,$msg3."</strong>
                            </div>";
                        }
                        if($status == 'Rejected')
                        {
                            echo "<div class= 'alert alert-danger'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Document rejected! Please upload a copy of your NIC again to complete this step</strong>
                            </div>";
                        }
                        if($Appstatus == 'Approved')
                        {
                            echo "<div class= 'alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Your application has been approved!
                                <li><a href='activity.php'> Click here </a> to view your application</li>
                                ".$askToPay."
                                </strong>
                            </div>";
                        }
                        else if($status == 'Approved')
                        {
                            echo "<div class= 'alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>This form is disabled, Your document has been approved!</strong>
                            </div>";
                        }
                ?>
                    Document requirements:
                    <ul>
                        <li>Upload the file in<strong> pdf</strong> format.</li>
                        <li>Both sides of the NIC should include in that pdf.</li>
                        <li>Content should be visible and clear.</li>
                        <li>NIC number in the ID should match the registered NIC number.</li>
                        <li>Documents with blurred images will be rejected.</li>
                    </ul>
                </p>
                <form class="uploader" action="NIC.inc.php" method="post" enctype="multipart/form-data" >
                    <label for="file-upload" class="outer" <?php echo $condition?>>
                        <img id="file-image" src="#" alt="Preview" class="hidden">
                        
                        <div id="start">
                            <label for ="select">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <div>Select a file</div>
                            </label>
                            <input type='file' id="select" style="display:none" name="file" <?php echo $condition?>>
                        </div>

                        <div>
                            <p id="chosenfile"></p>
                            <button type="submit" name="btn-upload" class="btn btn-success" <?php echo $condition?>>Upload</button>
                        </div>

                    </label>
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
