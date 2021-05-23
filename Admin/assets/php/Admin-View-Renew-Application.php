<?php
require_once 'admin-header.php';

$u_id = $_GET['user_id'];
$profile = mysqli_query($link, "SELECT * FROM users WHERE user_id ='" . $u_id . "'");
$row = mysqli_fetch_assoc($profile);

$application_data = mysqli_query($link, "SELECT * FROM user_details_renewal WHERE user_id ='" . $u_id . "'");
$application = mysqli_fetch_assoc($application_data);



?>

<div class="right_col" role="main" style="font-size: 12px;">
    <div class="row justify-content-center wrapper" style="font-size: 14px;">
        <div class="col-lg-7 bg-white p-4">
            <hr class="my-3" />

            <div class="row gutters-sm">

                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <br>
                            <h5 style="text-align: center;">User Details</h5>
                            <hr class="my-3" />

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
                           


                        </div>
                    </div>
                </div>

                <div class="card col-12 mt-3">
                    <br>
                    <h5 style="text-align: center;">Uploaded Documents</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"> Photograph</h6>
                            <span class="text-secondary">
                                <a href="view_renew.php?userID=<?php echo urlencode($row['user_id']); ?>&type=image"><button class="btn btn-outline-info" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                    </button></a>

                                <input type="submit" class="btn btn-outline-success" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="approve_photo" value="Approve">

                                <input type="submit" class="btn btn-outline-danger" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="reject_photo" value="Reject">
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"> Copy of Previous License </h6>
                            <span class="text-secondary">
                                <a href="view_renew.php?userID=<?php echo urlencode($row['user_id']); ?>&type=pdf&id=1"><button class="btn btn-outline-info" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                    </button></a>
                                <input type="submit" class="btn btn-outline-success" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="approve_license" value="Approve">

                                <input type="submit" class="btn btn-outline-danger" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="reject_license" value="Reject">

                            </span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Copy of Medical Certificate </h6>
                            <span class="text-secondary">
                                <a href="view_renew.php?userID=<?php echo urlencode($row['user_id']); ?>&type=pdf&id=2"><button class="btn btn-outline-info" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                    </button></a>
                                <input type="submit" class="btn btn-outline-success" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="approve_medical" value="Approve">

                                <input type="submit" class="btn btn-outline-danger" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="reject_medical" value="Reject">
                            </span>
                        </li>


                    </ul>
                </div>



            </div>

            <br>
            <div class="row">

                <buttton style="width: 100%;" data-bs-target="#ApproveModal" class="btn btn-success" data-bs-toggle="modal" id="approve">Approve</button>
            </div>

            <div class="row">
                <button style="width: 100%;" data-bs-target="#RejectModal" class="btn btn-danger" data-bs-toggle="modal" id="reject" >Reject</button>
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

                            <a href="Admin-Renewal.php"><button type="button" class="btn btn-success" id="Approve_Application">Approve</button></a>
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
                url: 'Action_Renew.php',
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

        $('#approve_license').click(function() {
            $action_s = "approve_license";
            $.ajax({
                method: 'POST',
                url: 'Action_Renew.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("approve_license").style.backgroundColor = "#5cb85c";
                    document.getElementById("approve_license").style.color = "white";

                    document.getElementById("reject_license").style.backgroundColor = "";
                    document.getElementById("reject_license").style.color = "";
                }
            });
        });

      

        $('#approve_medical').click(function() {
            $action_s = "approve_medical";
            $.ajax({
                method: 'POST',
                url: 'Action_Renew.php',
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
                url: 'Action_Renew.php',
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


        $('#reject_license').click(function() {
            $action_s = "reject_license";
            $.ajax({
                method: 'POST',
                url: 'Action_Renew.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    document.getElementById("reject_license").style.backgroundColor = "#d9534f";
                    document.getElementById("reject_license").style.color = "white";


                    document.getElementById("approve_license").style.backgroundColor = "";
                    document.getElementById("approve_license").style.color = "";
                }
            });
        });

        $('#reject_medical').click(function() {
            $action_s = "reject_medical";
            $.ajax({
                method: 'POST',
                url: 'Action_Renew.php',
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
                url: 'Action_Renew.php',
                data: {
                    action: $action_s,
                    id: uid
                },
                success: function(response) {
                    window.location.replace("Admin-Renewal.php");
                }

            });
        

      
        });


        $('#Reject_Application').click(function() {

            if ($('#reject_reason').val() != '') {

                var reason = $('#reject_reason').val();
                var action_s = "reject_Application";
                $.ajax({
                    method: 'POST',
                    url: 'Action_Renew.php',
                    data: {
                        action: action_s,
                        id: uid,
                        feedback: reason

                    },
                    success: function(response) {
                      //  alert(response);
                     window.location.replace("Admin-Renewal.php");
                    }

                });
            } else {
                $('#feedback_err').show();
            }

        

       
        });


  


    });
  

    
</script>
<?php
require_once 'admin-footer.php';
?>