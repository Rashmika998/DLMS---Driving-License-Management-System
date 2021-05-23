
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
            <a data-toggle="pill" class="nav-link active " href="#menu1" role="tab">Pending Issuals</a>
        </li>

        <li class="nav-item">
            <a data-toggle="pill" class="nav-link " href="#menu2" role="tab">Issued New License</a>
        </li>

      
    </ul>

    <div class="tab-content">
        <div id="menu2" class="tab-pane fade in" role="tabpanel">
            <br>

            
            <div class="row">
            <div class="col-1"></div>
               <div class="col-10 ">
               <div class="float-right">
                <form method="post" action="new_issued_export.php">
                    <div class="input-daterange">
                        <div class="col-md-4 mt-2">
                            <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                        </div>
                        <div class="col-md-4 mt-2">
                            <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <input type="submit" name="export" value="Export as PDF" class="btn btn-info btn-sm" />
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
                                <th scope="col"> State </th>
                                <th scope="col"> Issued On </th>

                            </tr>
                        </thead>

                        <?php
                        $con = mysqli_connect("localhost", "root", "", "dlms");

                        $sql = "SELECT * FROM users  INNER JOIN trial_result 
            ON users.user_id = trial_result.user_id WHERE trial_result.Issued_state=1 AND (
            
            trial_result.resultA1='Pass' OR     trial_result.resultA='Pass' OR   trial_result.resultB1='Pass' OR   trial_result.resultB='Pass' OR   trial_result.resultC1='Pass' OR   trial_result.resultC='Pass' OR
            trial_result.resultCE='Pass' OR   trial_result.resultD1='Pass' OR   trial_result.resultD='Pass' OR   trial_result.resultDE='Pass' OR   trial_result.resultG1='Pass' OR   trial_result.resultG='Pass' OR
            trial_result.resultJ='Pass')
            ";
            
         
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

                               
                                    <td><button class="btn btn-success">Issued</button></td>
                                   
                                    <td> <?php 
                                    echo $row['Issued_date'];  ?></td>

                               
                               
                              




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
                   
                    $sql1 = "SELECT * FROM users  INNER JOIN trial_result 
                    ON users.user_id = trial_result.user_id WHERE trial_result.Issued_state=1 AND (
                    
                    trial_result.resultA1='Pass' OR     trial_result.resultA='Pass' OR   trial_result.resultB1='Pass' OR   trial_result.resultB='Pass' OR   trial_result.resultC1='Pass' OR   trial_result.resultC='Pass' OR
                    trial_result.resultCE='Pass' OR   trial_result.resultD1='Pass' OR   trial_result.resultD='Pass' OR   trial_result.resultDE='Pass' OR   trial_result.resultG1='Pass' OR   trial_result.resultG='Pass' OR
                    trial_result.resultJ='Pass') ";
                  
                  $result1 = mysqli_query($con, $sql1);

                    if (mysqli_num_rows($result1) > 0) { ?>

                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                           Issue new license 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                    <?php } else if (mysqli_num_rows($result1) == 0) { ?>

                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            No new license issuals
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    <?php } ?>


                    <table class="table" id="new3Table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col" style="text-align: center;"> Action </th>

                            </tr>
                        </thead>

                        <?php

                        $con = mysqli_connect("localhost", "root", "", "dlms");


                        
                    $sql = "SELECT * FROM users  INNER JOIN trial_result 
                    ON users.user_id = trial_result.user_id WHERE trial_result.Issued_state IS NULL AND (
                    
                    trial_result.resultA1='Pass' OR     trial_result.resultA='Pass' OR   trial_result.resultB1='Pass' OR   trial_result.resultB='Pass' OR   trial_result.resultC1='Pass' OR   trial_result.resultC='Pass' OR
                    trial_result.resultCE='Pass' OR   trial_result.resultD1='Pass' OR   trial_result.resultD='Pass' OR   trial_result.resultDE='Pass' OR   trial_result.resultG1='Pass' OR   trial_result.resultG='Pass' OR
                    trial_result.resultJ='Pass') ";

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
                            

                                <td style="text-align: center;">
                                       
                                        <a class="btn btn-sm" role="button" style="background-color: #1fa67a;color: white;" href="New_issue.php?user_id=<?php echo $row['user_id'] ?>">
                                                <h7 style="text-align: center;">Issue&nbsp;<i class="fa fa-check" aria-hidden="true"></i></h7>
                                            </a>



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