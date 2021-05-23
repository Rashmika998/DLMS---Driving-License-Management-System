<?php
require_once 'admin-header.php';

function allUsers()
{
    $db = new mysqli('localhost', 'root', '', 'dlms');
    $all = mysqli_query($db, "SELECT * FROM users");
    $all_users = mysqli_num_rows($all);
    return $all_users;
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />
<div class="right_col" role="main">

    <!-- Add Admin -->
    <div class="row justify-content-center wrapper">
        <div class="col-lg-7 bg-white p-4">
            <h4 class="text-center font-weight-bold">Registered Users(<?php echo allUsers() ?>)</h4>
            <hr class="my-3" />
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="userTable" style="font-size: 14px;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">UserName</th>
                        </tr>
                    </thead>
                    <?php
                    $db = mysqli_connect("localhost", "root", "", "dlms");
                    $records = mysqli_query($db, "SELECT user_id, gender, user_name FROM users");

                    while ($data = mysqli_fetch_array($records)) {
                        // $_SESSION['learners_name'] = $data['learners_name'];
                    ?>
                        <tr>
                            <td>
                                <?php
                                if ($data['gender'] == "1") { ?>
                                    <img src="https://img.icons8.com/color/50/000000/user-male-circle--v1.png" />
                                <?php
                                } else if ($data['gender'] == "2") { ?>
                                    <img src="https://img.icons8.com/color/50/000000/user-female-circle--v1.png" />
                                <?php
                                } else { ?>
                                    <img src="https://img.icons8.com/material-rounded/24/000000/user.png" />
                                <?php
                                }

                                ?>
                                &nbsp;&nbsp;<?php echo $data['user_name']; ?>
                                <a style="float: right;" href="User-View-Profile.php?user_id=<?php echo $data['user_id'] ?>">View
                                    Profile <i class="fa fa-info-circle" aria-hidden="true"></i></a>
                            </td>
                        </tr>

                    <?php
                    }

                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <script src="vendor.bundle.base.js"></script> -->


<!-- footer content -->
<footer>
    <div class="pull-right">
        Driving License Management System
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="Header/vendors/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/r-2.2.7/sc-2.0.3/sp-1.2.2/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
</script>

<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>

</body>

</html>