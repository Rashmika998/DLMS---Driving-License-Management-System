<?php
require_once 'admin-header.php';

$u_id = $_GET['user_id'];
$profile = mysqli_query($link, "SELECT * FROM users WHERE user_id ='" . $u_id . "'");
$row = mysqli_fetch_assoc($profile);

$application_data = mysqli_query($link, "SELECT * FROM user_details WHERE user_id ='" . $u_id . "'");
$application = mysqli_fetch_assoc($application_data);



?>

<div class="right_col" role="main" style="font-size: 12px;">
    <div class="row justify-content-center wrapper" style="font-size: 14px;">
        <div class="col-lg-12 bg-white p-4">
            <hr class="my-3" />

            <div class="row gutters-sm">

                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 style="text-align: center;">User Details</h4>
                            <hr class="my-3" />
                            <div class="d-flex flex-column align-items-center text-center">
                            <?php
                            $get_users_tr = mysqli_query($link, "SELECT gender,user_name FROM users WHERE user_id = " . $row['user_id']);
                            if ($data = mysqli_fetch_array($get_users_tr)) {
                                if ($data['gender'] == "1") { ?>
                                    <img src="https://img.icons8.com/color/150/000000/user-male-circle--v1.png" />
                                <?php
                                } else if ($data['gender'] == "2") { ?>
                                    <img src="https://img.icons8.com/color/150/000000/user-female-circle--v1.png" />
                                <?php
                                } else { ?>
                                    <img src="https://img.icons8.com/material-rounded/150/000000/user.png" />
                            <?php
                                }
                            }
                            ?><h4><?php echo $row['user_name'] ?></h4><?php
                            ?>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['full_name'] ?>
                                </div>
                            </div>


                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Contact No</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['contact_no'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['user_email'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NIC Number</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['nic'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date of Birth</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $application['dob'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $application['address'] ?>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Province</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $application['province'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vehicle Type</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php
                                    if ($application['A1'] == 1) {
                                        echo "A1";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }

                                    if ($application['A'] == 1) {
                                        echo "A";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['B1'] == 1) {
                                        echo "B1";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['B'] == 1) {
                                        echo "B";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['C1'] == 1) {
                                        echo "C1";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['C'] == 1) {
                                        echo "C";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['D1'] == 1) {
                                        echo "D1";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['D'] == 1) {
                                        echo "D";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['DE'] == 1) {
                                        echo "DE";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['G1'] == 1) {
                                        echo "G1";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['G'] == 1) {
                                        echo "G";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }
                                    if ($application['J'] == 1) {
                                        echo "J";
                                        echo '&nbsp';
                                        echo '&nbsp';
                                        echo '&nbsp';
                                    }

                                    ?>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 style="text-align: center;">Uploaded Documents</h4>
                            <hr class="my-3" />
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"> Photograph</h6>
                                    <span class="text-secondary">
                                        <a href="view.php?userID=<?php echo urlencode($row['user_id']); ?>&type=image"><button class="btn btn-outline-info" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                            </button></a>

                                        <input type="submit" class="btn btn-outline-success" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="approve_photo" value="Approve">

                                        <input type="submit" class="btn btn-outline-danger" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="reject_photo" value="Reject">
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"> Copy of NIC </h6>
                                    <span class="text-secondary">
                                        <a href="view.php?userID=<?php echo urlencode($row['user_id']); ?>&type=pdf&id=1"><button class="btn btn-outline-info" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                            </button></a>
                                        <input type="submit" class="btn btn-outline-success" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="approve_nic" value="Approve">

                                        <input type="submit" class="btn btn-outline-danger" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="reject_nic" value="Reject">

                                    </span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"> Copy of Birth Certificate </h6>
                                    <span class="text-secondary">
                                        <a href="view.php?userID=<?php echo urlencode($row['user_id']); ?>&type=pdf&id=2"><button class="btn btn-outline-info" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                            </button></a>
                                        <input type="submit" class="btn btn-outline-success" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="approve_bc" value="Approve">

                                        <input type="submit" class="btn btn-outline-danger" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="reject_bc" value="Reject">
                                    </span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Copy of Medical Certificate </h6>
                                    <span class="text-secondary">
                                        <a href="view.php?userID=<?php echo urlencode($row['user_id']); ?>&type=pdf&id=3"><button class="btn btn-outline-info" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                            </button></a>
                                        <input type="submit" class="btn btn-outline-success" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="approve_medical" value="Approve">

                                        <input type="submit" class="btn btn-outline-danger" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="reject_medical" value="Reject">
                                    </span>
                                </li>


                            </ul>
                            <br>
                            <div class="row">

                                <buttton style="width: 100%;" data-bs-target="#ApproveModal" class="btn btn-success" data-bs-toggle="modal" id="approve">Approve</button>
                            </div>

                            <div class="row">
                                <button style="width: 100%;" data-bs-target="#RejectModal" class="btn btn-danger" data-bs-toggle="modal" id="reject">Reject</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>




            <!-- Modal Approve -->
            <div class="modal fade" id="ApproveModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Approve Application</h5>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                        <div class="modal-body">
                            Please confirm the approval of the application
                        </div>
                        <div class="modal-footer">

                            <a href="Admin-NLicense.php"><button type="button" class="btn btn-success" id="Approve_Application">Approve</button></a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go Back</button>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Reject -->
            <div class="modal fade" id="RejectModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                        <div class="modal-body">
                            Please confirm the rejection of the application
                            <br>
                            <br>

                            <label for="reject_reason"> Reason for the rejection</label>
                            <input type="text" class="form-control" id="reject_reason">
                            <br>
                            <div class="alert alert-danger alert-dismissible fade show" id="feedback_err" style="display: none;" role="alert">Please give your feedback </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger" id="Reject_Application">Reject</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go Back</button>

                        </div>
                    </div>
                </div>
            </div>









        </div>
    </div>
</div>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
</script>



<script>
    var uid = <?php echo $u_id ?>;

    $(document).ready(function() {


        $('#approve_photo').click(function() {
            $action_s = "approve_photo";
            $.ajax({
                method: 'POST',
                url: 'Action.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("approve_photo").style.backgroundColor = "#5cb85c";
                    document.getElementById("approve_photo").style.color = "white";

                    document.getElementById("reject_photo").style.backgroundColor = "";
                    document.getElementById("reject_photo").style.color = "";

                }
            });
        });

        $('#approve_nic').click(function() {
            $action_s = "approve_nic";
            $.ajax({
                method: 'POST',
                url: 'Action.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("approve_nic").style.backgroundColor = "#5cb85c";
                    document.getElementById("approve_nic").style.color = "white";

                    document.getElementById("reject_nic").style.backgroundColor = "";
                    document.getElementById("reject_nic").style.color = "";
                }
            });
        });

        $('#approve_bc').click(function() {
            $action_s = "approve_bc";
            $.ajax({
                method: 'POST',
                url: 'Action.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("approve_bc").style.backgroundColor = "#5cb85c";
                    document.getElementById("approve_bc").style.color = "white";

                    document.getElementById("reject_bc").style.backgroundColor = "";
                    document.getElementById("reject_bc").style.color = "";
                }
            });
        });

        $('#approve_medical').click(function() {
            $action_s = "approve_medical";
            $.ajax({
                method: 'POST',
                url: 'Action.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("approve_medical").style.backgroundColor = "#5cb85c";
                    document.getElementById("approve_medical").style.color = "white";

                    document.getElementById("reject_medical").style.backgroundColor = "";
                    document.getElementById("reject_medical").style.color = "";
                }
            });
        });


        $('#reject_photo').click(function() {
            $action_s = "reject_photo";
            $.ajax({
                method: 'POST',
                url: 'Action.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("reject_photo").style.backgroundColor = "#d9534f";
                    document.getElementById("reject_photo").style.color = "white";


                    document.getElementById("approve_photo").style.backgroundColor = "";
                    document.getElementById("approve_photo").style.color = "";
                }
            });
        });


        $('#reject_nic').click(function() {
            $action_s = "reject_nic";
            $.ajax({
                method: 'POST',
                url: 'Action.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("reject_nic").style.backgroundColor = "#d9534f";
                    document.getElementById("reject_nic").style.color = "white";


                    document.getElementById("approve_nic").style.backgroundColor = "";
                    document.getElementById("approve_nic").style.color = "";
                }
            });
        });


        $('#reject_bc').click(function() {
            $action_s = "reject_bc";
            $.ajax({
                method: 'POST',
                url: 'Action.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("reject_bc").style.backgroundColor = "#d9534f";
                    document.getElementById("reject_bc").style.color = "white";


                    document.getElementById("approve_bc").style.backgroundColor = "";
                    document.getElementById("approve_bc").style.color = "";
                }
            });
        });

        $('#reject_medical').click(function() {
            $action_s = "reject_medical";
            $.ajax({
                method: 'POST',
                url: 'Action.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("reject_medical").style.backgroundColor = "#d9534f";
                    document.getElementById("reject_medical").style.color = "white";


                    document.getElementById("approve_medical").style.backgroundColor = "";
                    document.getElementById("approve_medical").style.color = "";
                }
            });
        });

        $('#Approve_Application').click(function() {
            $action_s = "Approve_Application";
            $.ajax({
                method: 'POST',
                url: 'Action.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    window.location.replace("Admin-NLicense.php");
                }

            });



        });


        $('#Reject_Application').click(function() {

            if ($('#reject_reason').val() != '') {

                var reason = $('#reject_reason').val();
                var action_s = "reject_Application";
                $.ajax({
                    method: 'POST',
                    url: 'Action.php',
                    data: {
                        action: action_s,
                        id: uid,
                        feedback: reason

                    },
                    success: function(response) {
                        window.location.replace("Admin-NLicense.php");
                    }

                });
            } else {
                $('#feedback_err').show();
            }




        });





    });
    $('#approve').click(function() {
        if (photo_status == 1 && nic_status == 1 && bc_status == 1 && medical_status == 1) {} else {
            alert("LLL");
        }


    });
</script>
<?php
require_once 'admin-footer.php';
?>