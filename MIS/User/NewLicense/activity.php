<?php
require_once '../../includes/db.inc.php';
require_once 'newLicenseHeader.php';
$id = $_SESSION["userid"];
$A1 = $A = $B1 = $B = $C1 = $C = $CE = $D1 = $D = $DE = $G1 = $G =$J = '';  
$address = $province = $dob = $Fname = $gender = $email = $contactNo =$nic = '';  
$user=0;//new user 
$status = NULL;
$askToPay="<a href='../Paypage/paypage.php'>Click here</a> to pay the registration fee";

//checking whether user already registered or not
$sql = "SELECT * FROM user_details WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) 
{
    $user=1;//registered user
    $address = $row['address'];
    $province = $row['province'];
    $dob = $row['dob'];
    $status = $row['status'];
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
}

//checking whether user already registered or not
$sql = "SELECT * FROM users WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) 
{
    $Fname = $row['full_name'];
    $gender = $row['gender'];
    $email = $row['user_email'];
    $contactNo = $row['contact_no'];
    $nic = $row['nic'];
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
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Check License Application Form Details
                </button>
                </h2>
            </div>
            
            <div id="collapseOne" class="collapse show">
            <?php
            if ($status == NULL)
            {
                echo "<div class='card-body'>
                            <div class= 'alert alert-info'>
                                <strong>You haven't submit your registration form yet. <a href='RegisterForLicense.php'>Click here</a> to register</strong>
                            </div>
                    <p class='card-text'>After you submit the form it'll go through a validation process. Once it's approved you can view it here.</p>
                </div>";
            }
            if ($status == 'Approved')
            {
                echo "<div class='card-body'>
                            <div class= 'alert alert-success'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Your form has been approved!".$askToPay."</strong>
                            </div>
                <h5 class='card-title'>User Details</h5>
                <form>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Full Name</label>
                        <div class='col-sm-10'>
                        <input  class='form-control'  value='$Fname' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class='col-sm-2 col-form-label'>Permanent Address</label>
                        <div class='col-sm-10'>
                        <input  class='form-control'  value=' $address' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Province</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$province' disabled>
                        </div>
                    
                        <label class=' col-sm-2 col-form-label'>NIC Number</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$nic' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Gender</label>
                        <div class='col-sm-4'>
                        <input  class='form-control' value=' $gender' disabled>
                        </div>
                    
                        <label class=' col-sm-2 col-form-label'>Contact Number</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$contactNo' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Date of Birth</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value=' $dob' disabled>
                        </div>

                        <label class=' col-sm-2 col-form-label'>Email Address</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$email' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Applying Vehicle Types</label> &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class='form-check-inline'>
                            <label class='form-check-label'> <input type='checkbox' disabled  $A1 class='form-check-input' >A1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $A class='form-check-input' >A &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $B1 class='form-check-input' >B1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $B class='form-check-input' >B &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $C1 class='form-check-input' >C1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $C class='form-check-input' >C &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $CE class='form-check-input' >CE &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $D1 class='form-check-input' >D1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $D class='form-check-input' >D &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $DE class='form-check-input' >DE &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $G1 class='form-check-input' >G1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $G class='form-check-input' >G &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $J class='form-check-input' >J &nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                    </div>
                </form>
                    <!--------------- View Documents ----------------------------->
                    <br>
                    <h5 class='card-title'>Uploaded Documents</h5>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'> Photograph</h6>
                            <span class='text-secondary'>
                                <a href='view.php?userID=$id; &type=image'><button class='btn btn-outline-info' style='font-size: smaller;' data-bs-toggle='modal' data-bs-target='#exampleModal'>View
                                    </button></a>
                            </span>
                        </li>
                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'> Copy of NIC </h6>
                            <span class='text-secondary'>
                                <a href='view.php?userID=$id; &type=pdf&pid=1'><button class='btn btn-outline-info' style='font-size: smaller;' data-bs-toggle='modal' data-bs-target='#exampleModal'>View
                                    </button></a>


                            </span>
                        </li>

                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'> Copy of Birth Certificate </h6>
                            <span class='text-secondary'>
                                <a href='view.php?userID=$id; &type=pdf&pid=2'><button class='btn btn-outline-info' style='font-size: smaller;' >View
                                    </button></a>

                            </span>
                        </li>

                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'>Medical Certificate </h6>
                            <span class='text-secondary'>
                            <a href='view.php?userID=$id; &type=pdf&pid=3'><button class='btn btn-outline-info' style='font-size: smaller;' >View
                                    </button></a> 

                            </span>
                        </li>


                    </ul>
                


                    
                    <!--------------- View Documents ----------------------------->
                
                </div>";
            }


            if ($status == 'Rejected')
            {
                echo "<div class='card-body'>
                            <div class= 'alert alert-danger'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Your form has been rejected!</strong>
                            </div>
                <h5 class='card-title'>User Details</h5>
                <form>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Full Name</label>
                        <div class='col-sm-10'>
                        <input  class='form-control'  value='$Fname' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class='col-sm-2 col-form-label'>Permanent Address</label>
                        <div class='col-sm-10'>
                        <input  class='form-control'  value=' $address' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Province</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$province' disabled>
                        </div>
                    
                        <label class=' col-sm-2 col-form-label'>NIC Number</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$nic' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Gender</label>
                        <div class='col-sm-4'>
                        <input  class='form-control' value=' $gender' disabled>
                        </div>
                    
                        <label class=' col-sm-2 col-form-label'>Contact Number</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$contactNo' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Date of Birth</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value=' $dob' disabled>
                        </div>

                        <label class=' col-sm-2 col-form-label'>Email Address</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$email' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Applying Vehicle Types</label> &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class='form-check-inline'>
                            <label class='form-check-label'> <input type='checkbox' disabled  $A1 class='form-check-input' >A1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $A class='form-check-input' >A &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $B1 class='form-check-input' >B1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $B class='form-check-input' >B &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $C1 class='form-check-input' >C1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $C class='form-check-input' >C &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $CE class='form-check-input' >CE &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $D1 class='form-check-input' >D1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $D class='form-check-input' >D &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $DE class='form-check-input' >DE &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $G1 class='form-check-input' >G1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $G class='form-check-input' >G &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $J class='form-check-input' >J &nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                    </div>
                </form>
                    <!--------------- View Documents ----------------------------->
                    <br>
                    <h5 class='card-title'>Uploaded Documents</h5>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'> Photograph</h6>
                            <span class='text-secondary'>
                                <a href='view.php?userID=$id; &type=image'><button class='btn btn-outline-info' style='font-size: smaller;' data-bs-toggle='modal' data-bs-target='#exampleModal'>View
                                    </button></a>
                            </span>
                        </li>
                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'> Copy of NIC </h6>
                            <span class='text-secondary'>
                                <a href='view.php?userID=$id; &type=pdf&pid=1'><button class='btn btn-outline-info' style='font-size: smaller;' data-bs-toggle='modal' data-bs-target='#exampleModal'>View
                                    </button></a>


                            </span>
                        </li>

                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'> Copy of Birth Certificate </h6>
                            <span class='text-secondary'>
                                <a href='view.php?userID=$id; &type=pdf&pid=2'><button class='btn btn-outline-info' style='font-size: smaller;' >View
                                    </button></a>

                            </span>
                        </li>

                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'>Medical Certificate </h6>
                            <span class='text-secondary'>
                            <a href='view.php?userID=$id; &type=pdf&pid=3'><button class='btn btn-outline-info' style='font-size: smaller;' >View
                                    </button></a> 

                            </span>
                        </li>


                    </ul>
                


                    
                    <!--------------- View Documents ----------------------------->
                
                </div>";
            }



            if ($status == 'Pending')
            {
                echo "<div class='card-body'>
                            <div class= 'alert alert-info'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong>Your form is still processing!</strong>
                            </div>
                <h5 class='card-title'>User Details</h5>
                <form>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Full Name</label>
                        <div class='col-sm-10'>
                        <input  class='form-control'  value='$Fname' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class='col-sm-2 col-form-label'>Permanent Address</label>
                        <div class='col-sm-10'>
                        <input  class='form-control'  value=' $address' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Province</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$province' disabled>
                        </div>
                    
                        <label class=' col-sm-2 col-form-label'>NIC Number</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$nic' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Gender</label>
                        <div class='col-sm-4'>
                        <input  class='form-control' value=' $gender' disabled>
                        </div>
                    
                        <label class=' col-sm-2 col-form-label'>Contact Number</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$contactNo' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Date of Birth</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value=' $dob' disabled>
                        </div>

                        <label class=' col-sm-2 col-form-label'>Email Address</label>
                        <div class='col-sm-4'>
                        <input  class='form-control'  value='$email' disabled>
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <label class=' col-sm-2 col-form-label'>Applying Vehicle Types</label> &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class='form-check-inline'>
                            <label class='form-check-label'> <input type='checkbox' disabled  $A1 class='form-check-input' >A1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $A class='form-check-input' >A &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $B1 class='form-check-input' >B1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $B class='form-check-input' >B &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $C1 class='form-check-input' >C1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $C class='form-check-input' >C &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $CE class='form-check-input' >CE &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $D1 class='form-check-input' >D1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $D class='form-check-input' >D &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $DE class='form-check-input' >DE &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $G1 class='form-check-input' >G1 &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $G class='form-check-input' >G &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <label class='form-check-label'> <input type='checkbox' disabled  $J class='form-check-input' >J &nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                    </div>
                </form>
                    <!--------------- View Documents ----------------------------->
                    <br>
                    <h5 class='card-title'>Uploaded Documents</h5>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'> Photograph</h6>
                            <span class='text-secondary'>
                                <a href='view.php?userID=$id; &type=image'><button class='btn btn-outline-info' style='font-size: smaller;' data-bs-toggle='modal' data-bs-target='#exampleModal'>View
                                    </button></a>
                            </span>
                        </li>
                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'> Copy of NIC </h6>
                            <span class='text-secondary'>
                                <a href='view.php?userID=$id; &type=pdf&pid=1'><button class='btn btn-outline-info' style='font-size: smaller;' data-bs-toggle='modal' data-bs-target='#exampleModal'>View
                                    </button></a>


                            </span>
                        </li>

                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'> Copy of Birth Certificate </h6>
                            <span class='text-secondary'>
                                <a href='view.php?userID=$id; &type=pdf&pid=2'><button class='btn btn-outline-info' style='font-size: smaller;' >View
                                    </button></a>

                            </span>
                        </li>

                        <li class='list-group-item d-flex justify-content-between align-items-center flex-wrap'>
                            <h6 class='mb-0'>Medical Certificate </h6>
                            <span class='text-secondary'>
                            <a href='view.php?userID=$id; &type=pdf&pid=3'><button class='btn btn-outline-info' style='font-size: smaller;' >View
                                    </button></a> 

                            </span>
                        </li>


                    </ul>
                


                    
                    <!--------------- View Documents ----------------------------->
                
                </div>";
            }

                ?>                
                
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Check Enrolled Driving Schools
                </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse">
                <div class="card-body table-responsive">
                    <table class="table ">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Driving School Name</th>
                                    <th scope="col">Driving School Contact No</th>
                                    <th scope="col">Driving School Email</th>
                                    <th scope="col">Driving School Website</th>
                                    <th scope="col">Total Payment</th>
                                    <th scope="col">Joined on</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT users_learners.joined_on, users_learners.amount, learners.learners_name, 
                                    learners.learners_contact, learners.learners_email, learners.learners_website, learners.learners_address
                                    FROM users_learners, learners  WHERE users_learners.learners_id = learners.learners_id AND users_learners.user_id=$id;";
                                    $i = 0;
                                    $new=0;
                                    $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $new=1;
                                        $i++;
                                        echo "  <tr>
                                                    <td>".$i."</td>
                                                    <td translate='no'>".$row['learners_name']."</td>
                                                    <td>".$row['learners_contact']."</td>
                                                    <td>".$row['learners_email']."</td>
                                                    <td>".$row['learners_website']."</td>
                                                    <td>Rs ".$row['amount'].".00</td>
                                                    <td>".$row['joined_on']."</td>
                                                </tr>
                                        ";
                                    }

                                    if( $new==0)
                                    {
                                        echo "  <tr>
                                                    <td colspan='6'><h5>You still haven't enrolled to any Driving school.<a href='Learners.php'> Click here </a>to register
                                                    </h5></td>
                                                </tr>
                                        ";

                                    }
                                ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Check Payment Details
                </button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse">
                <div class="card-body table-responsive">
                    <table class="table ">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Voucher reference no</th>
                                <th scope="col">Paid at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql = "SELECT * FROM payments WHERE user_id = $id;";
                                $i = 0;
                                $new2 = 0;
                                $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $i++;
                                    $new2=1;
                                    echo "  <tr>
                                                <td>".$i."</td>
                                                <td>".$row['Description']."</td>
                                                <td>Rs ".$row['amount'].".00</td>
                                                <td>".$row['token']."</td>
                                                <td>".$row['paid_at']."</td>
                                            </tr>
                                    ";
                                }
                                if( $new2==0)
                                    {
                                        echo "  <tr>
                                                    <td colspan='6'><h5>No transactions to show yet
                                                    </h5></td>
                                                </tr>
                                        ";

                                    }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
require_once 'footer.php';
?>