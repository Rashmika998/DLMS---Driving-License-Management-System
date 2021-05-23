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
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"> Copy of Previous License </h6>
                            <span class="text-secondary">
                                <a href="view_renew.php?userID=<?php echo urlencode($row['user_id']); ?>&type=pdf&id=1"><button class="btn btn-outline-info" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                    </button></a>


                            </span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Copy of Medical Certificate </h6>
                            <span class="text-secondary">
                                <a href="view_renew.php?userID=<?php echo urlencode($row['user_id']); ?>&type=pdf&id=2"><button class="btn btn-outline-info" style="font-size: smaller;" data-bs-toggle="modal" data-bs-target="#exampleModal">View
                                    </button></a>

                            </span>
                        </li>


                    </ul>
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




<?php
require_once 'admin-footer.php';
?>