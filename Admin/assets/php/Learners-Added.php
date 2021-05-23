<?php
session_start();
require_once 'admin-header.php'; 

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="row justify-content-center wrapper" style="padding-top: 200px;">
        <div class="col-lg-7 bg-white p-4">
            <div class="row justify-content-center"><i class="fa fa-check-circle-o fa-5x" aria-hidden="true"></i></div>
            <p class="row justify-content-center" style="font-size: 20px;">Driving School Admin Account Created Successfully!</p>
            <div class="row justify-content-center" style="padding-left: 15px;">
                <a href="Learners-Add.php"> <button type="button" class="btn btn-success row justify-center">Done</button></a>
            </div>

        </div>
    </div>
</div>

<?php
require_once 'admin-footer.php'; 

?>