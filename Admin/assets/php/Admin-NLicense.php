<?php

require_once 'admin-header.php';
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="Header/vendors/jquery/dist/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<div class="right_col" role="main">
    <p style="color: white;">c</p>
    <ul class="nav nav-pills nav-fill">
        <li class="nav-item ">
            <a data-toggle="pill" class="nav-link active " href="#menu1" role="tab">New License Applications</a>
        </li>

        <li class="nav-item">
            <a data-toggle="pill" class="nav-link " href="#menu2" role="tab">Approved License Applications</a>
        </li>

        <li class="nav-item">
            <a data-toggle="pill" class="nav-link " href="#menu3" role="tab">Rejected License Applications</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="menu2" class="tab-pane fade in" role="tabpanel">
            <br>

            
            <div class="row">
            <div class="col-1"></div>
               <div class="col-10 ">
               <div class="float-right">
                <form method="post" action="approved_newlicense_export.php">
                    <div class="input-daterange">
                        <div class="col-md-4 mt-2">
                            <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                        </div>
                        <div class="col-md-4 mt-2">
                            <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
                    </div>
                </form>
                </div>
                </div>

                <div class="col-1"></div>
            </div>

            <div class="row mt-4">

                <div class="col-1">

                </div>
                <div class="col-10">

                    <table class="table" id="newTable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col"> Status </th>
                                <th scope="col"> Action </th>

                            </tr>
                        </thead>

                        <?php
                        $con = mysqli_connect("localhost", "root", "", "dlms");

                        $sql = "SELECT * FROM users  INNER JOIN user_details
            ON users.user_id = user_details.user_id WHERE user_details.status='Approved'; ";
                        $result = mysqli_query($con, $sql);


                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td>
                                    <?php $get_users_tr = mysqli_query($con, "SELECT gender FROM users WHERE user_id = " . $row['user_id']);
                                    if ($data = mysqli_fetch_array($get_users_tr)) {
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
                                    }
                                    echo $row['full_name']; ?>
                                </td>
                                <td><button class="btn btn-success">Approved</button></td>
                                <td>
                                <a class="btn btn-primary btn-sm" role="button" href="Admin-Approved-Application.php?user_id=<?php echo $row['user_id'] ?>">View Application <i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                </td>
                              




                            </tr>

                        <?php
                        }
                        mysqli_close($con);

                        ?>


                    </table>
                </div>

                <div class="col-1"></div>
            </div>

        </div>


        <div id="menu3" class="tab-pane fade in" role="tabpanel">
            <br>

            
            <div class="row">
            <div class="col-1"></div>
               <div class="col-10 ">
               <div class="float-right">
               <form method="post" action="rejected_newlicense_export.php">
                    <div class="input-daterange">
                        <div class="col-md-4 mt-2">
                            <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                        </div>
                        <div class="col-md-4 mt-2">
                            <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
                    </div>
                </form>
                </div>
                </div>

                <div class="col-1"></div>
            </div>

            <div class="row mt-4">

                <div class="col-1">

                </div>
                <div class="col-10">

                    <table class="table" id="new2Table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col"> Status </th>
                                <th scope="col"> Action </th>

                            </tr>
                        </thead>

                        <?php
                        $con = mysqli_connect("localhost", "root", "", "dlms");

                        $sql = "SELECT * FROM users  INNER JOIN user_details
            ON users.user_id = user_details.user_id WHERE user_details.status='Rejected'; ";
                        $result = mysqli_query($con, $sql);


                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                            <td><?php $get_users_tr = mysqli_query($con, "SELECT gender FROM users WHERE user_id = " . $row['user_id']);
                                    if ($data = mysqli_fetch_array($get_users_tr)) {
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
                                    }
                                    echo $row['full_name']; ?>
                            </td>
                                <td><button class="btn btn-danger">Rejected</button></td>

                                <td>
                                <a class="btn btn-primary btn-sm" role="button" href="Admin-Approved-Application.php?user_id=<?php echo $row['user_id'] ?>">View Application <i class="fa fa-info-circle" aria-hidden="true"></i></a>

                                </td>




                            </tr>

                        <?php
                        }
                        mysqli_close($con);

                        ?>


                    </table>
                </div>

                <div class="col-1"></div>
            </div>

        </div>


        <div id="menu1" class="tab-pane fade in " role="tabpanel">
            <br>
            <div class="row">

                <div class="col-1">

                </div>
                <div class="col-10">

                    <?php

                    $con = mysqli_connect("localhost", "root", "", "dlms");

                    $sql1 = "SELECT * FROM users  INNER JOIN user_details 
ON users.user_id = user_details.user_id WHERE user_details.status='Pending'; ";
                    $result1 = mysqli_query($con, $sql1);

                    if (mysqli_num_rows($result1) > 0) { ?>

                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Review applications for new license 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                    <?php } else if (mysqli_num_rows($result1) == 0) { ?>

                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            No new applications for new license 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    <?php } ?>


                    <table class="table" id="new3Table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col"> Status </th>
                                <th scope="col"> Action </th>

                            </tr>
                        </thead>

                        <?php

                        $con = mysqli_connect("localhost", "root", "", "dlms");

                        $sql = "SELECT * FROM users  INNER JOIN user_details ON users.user_id = user_details.user_id WHERE user_details.status='Pending'; ";
                        $result = mysqli_query($con, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td>    <?php $get_users_tr = mysqli_query($con, "SELECT gender FROM users WHERE user_id = " . $row['user_id']);
                                    if ($data = mysqli_fetch_array($get_users_tr)) {
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
                                    }
                                    echo $row['full_name']; ?></td>
                                <td>

                                    <?php
                                    $sql1 = "SELECT user_id , status  FROM user_details WHERE user_id= '" . $row['user_id'] . "'";
                                    $result1 = mysqli_query($con, $sql1);

                                    if ($result1) {
                                        $data = mysqli_fetch_array($result1);
                                        echo $data['status'];
                                    }
                                    ?>

                                </td>

                                <td style="text-align: center;">
                                <a class="btn btn-secondary btn-sm" href="Admin-View-Application.php?user_id=<?php echo $row['user_id'] ?>">View <i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                    </td>

                         




                            </tr>

                        <?php
                        }
                        ?>

                    </table>
                </div>
                <div class="col-1"></div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#menu1').tab('show')
    });
</script>

<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>

<!-- footer content -->
<footer>
    <div class="pull-right">
        Driving License Management System
    </div>
    <div class="clearfix"></div>
</footer>

<!-- /footer content -->

<!-- jQuery -->

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/r-2.2.7/sc-2.0.3/sp-1.2.2/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#newTable').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $('#new2Table').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#new3Table').DataTable();
    });
</script>


<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>

</body>

</html>