<?php

require_once 'includes/db.inc.php';
require_once 'Header.php';

$learners_id = $_SESSION["learnersid"];

?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div class="right_col" role="main">
    <p style="color: white;">c</p>
    <ul class="nav nav-pills nav-fill">
        <li class="nav-item ">
            <a data-toggle="pill" class="nav-link  " href="#menu1" role="tab">Practise Sessions</a>
        </li>

        <li class="nav-item">
            <a data-toggle="pill" class="nav-link active" href="#menu2" role="tab">Schedule Practise Sessions</a>
        </li>

    </ul>

    <div class="tab-content">
        <div id="menu1" class="tab-pane fade in" role="tabpanel">
            <br>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <table class="table" style="align-self: center;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>

                                <th scope="col" style="text-align: center;"> License Type</th>

                                <th scope="col" style="text-align: center;"> Schedule </th>

                            </tr>

                        </thead>

                        <?php
                        $con = mysqli_connect("localhost", "root", "", "dlms");

                        $sql = "SELECT * FROM users_learners WHERE learners_id='" . $learners_id . "' AND scheduled=1 ; ";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) == 0) { ?>
                            <tr>
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    No new schedules are available
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </tr>

                        <?php } else { ?>

                            <tr>
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    Scheduled training sessions for registered users
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </tr>
                        <?php }


                        while ($row = mysqli_fetch_array($result)) {
                            $user_id = $row['user_id'];
                            $sql1 = "SELECT * FROM user_details WHERE user_id='" . $user_id . "'";
                            $records1 = mysqli_query($link, $sql1);
                            $data = mysqli_fetch_assoc($records1);


                            $sql2 = "SELECT * FROM users WHERE user_id='" . $user_id . "'";
                            $records2 = mysqli_query($link, $sql2);
                            $info = mysqli_fetch_assoc($records2);

                        ?>
                            <tr>
                                <td><?php echo $info['full_name'] ?></td>
                                <td>
                                    <?php
                                    if ($data['A1'] == 1) {
                                        echo "A1&nbsp&nbsp";
                                    }
                                    if ($data['A'] == 1) {
                                        echo "A&nbsp&nbsp";
                                    }
                                    if ($data['B1'] == 1) {
                                        echo "B1&nbsp&nbsp";
                                    }
                                    if ($data['B'] == 1) {
                                        echo "B&nbsp&nbsp";
                                    }
                                    if ($data['C1'] == 1) {
                                        echo "C1&nbsp&nbsp";
                                    }
                                    if ($data['C'] == 1) {
                                        echo "C&nbsp&nbsp";
                                    }

                                    if ($data['CE'] == 1) {
                                        echo "CE&nbsp&nbsp";
                                    }
                                    if ($data['D1'] == 1) {
                                        echo "D1&nbsp&nbsp";
                                    }
                                    if ($data['D'] == 1) {
                                        echo "D&nbsp&nbsp";
                                    }
                                    if ($data['DE'] == 1) {
                                        echo "DE&nbsp&nbsp";
                                    }
                                    if ($data['G1'] == 1) {
                                        echo "G1&nbsp&nbsp";
                                    }
                                    if ($data['G'] == 1) {
                                        echo "G&nbsp&nbsp";
                                    }
                                    if ($data['J'] == 1) {
                                        echo "J&nbsp&nbsp";
                                    }

                                    ?>

                                </td>


                                <td style="text-align: center;">

                                    <button type="button" class="btn btn-sm btn-info" data-toggle="popover" title="More Information" data-placement="bottom" data-html="true" data-content="Contact Number : <?php echo $info['contact_no'] ?> <br><br>
                            NIC Number : <?php echo $info['nic'] ?> <br><br>
                            Email : <?php echo $info['user_email'] ?> <br><br>">
                                        More</button>
                                    <a type="button" class="btn btn btn-sm btn-success ViewscheduleBTN" data-id=<?php echo $user_id ?>>
                                        View
                                    </a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                                    <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">
                                                        <i class="fa fa-times" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this schedule?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="User-Delete.php?user_id=<?php echo $user_id?>"><button type="button" class="btn btn-danger">Yes</button></a>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

        <div id="menu2" class="tab-pane fade in" role="tabpanel">
            <br>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <table class="table" style="align-self: center;">
                        <thead class="thead-light">
                            <tr>
                                <th style="display: none;">ID</th>
                                <th>Name</th>
                                <th> License Type</th>
                                <th> Action </th>

                            </tr>

                        </thead>

                        <?php
                        $con = mysqli_connect("localhost", "root", "", "dlms");

                        $sql = "SELECT * FROM users_learners WHERE learners_id='" . $learners_id . "' AND scheduled=0; ";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) == 0) { ?>
                            <tr>
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    No newly registerd users
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </tr>

                        <?php } else { ?>

                            <tr>
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    Schedule training sessions for newly registerd users
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </tr>
                        <?php }

                        while ($row = mysqli_fetch_array($result)) {
                            $user_id = $row['user_id'];
                            $sql1 = "SELECT * FROM user_details WHERE user_id='" . $user_id . "'";
                            $records1 = mysqli_query($link, $sql1);
                            $data = mysqli_fetch_assoc($records1);


                            $sql2 = "SELECT * FROM users WHERE user_id='" . $user_id . "'";
                            $records2 = mysqli_query($link, $sql2);
                            $info = mysqli_fetch_assoc($records2);

                        ?>
                            <tr>
                                <td style="display: none;" class="id"><?php echo $user_id ?></td>
                                <td> <?php echo $info['full_name'] ?></td>


                                <td>
                                    <?php
                                    if ($data['A1'] == 1) {
                                        echo "A1&nbsp&nbsp";
                                    }
                                    if ($data['A'] == 1) {
                                        echo "A&nbsp&nbsp";
                                    }
                                    if ($data['B1'] == 1) {
                                        echo "B1&nbsp&nbsp";
                                    }
                                    if ($data['B'] == 1) {
                                        echo "B&nbsp&nbsp";
                                    }
                                    if ($data['C1'] == 1) {
                                        echo "C1&nbsp&nbsp";
                                    }
                                    if ($data['C'] == 1) {
                                        echo "C&nbsp&nbsp";
                                    }

                                    if ($data['CE'] == 1) {
                                        echo "CE&nbsp&nbsp";
                                    }
                                    if ($data['D1'] == 1) {
                                        echo "D1&nbsp&nbsp";
                                    }
                                    if ($data['D'] == 1) {
                                        echo "D&nbsp&nbsp";
                                    }
                                    if ($data['DE'] == 1) {
                                        echo "DE&nbsp&nbsp";
                                    }
                                    if ($data['G1'] == 1) {
                                        echo "G1&nbsp&nbsp";
                                    }
                                    if ($data['G'] == 1) {
                                        echo "G&nbsp&nbsp";
                                    }
                                    if ($data['J'] == 1) {
                                        echo "J&nbsp&nbsp";
                                    }

                                    ?>

                                </td>


                                <td>

                                    <button type="button" class="btn btn-sm btn-info" data-toggle="popover" title="More Information" data-placement="bottom" data-html="true" data-content="Contact Number : <?php echo $info['contact_no'] ?> <br><br>
                            NIC Number : <?php echo $info['nic'] ?> <br><br>
                            Email : <?php echo $info['user_email'] ?> <br><br>">More Info</button>

                                    <a type="button" class="btn btn btn-sm btn-success scheduleBTN" data-id=<?php echo $user_id ?>>
                                        Schedule
                                    </a>

                                </td>
                            </tr>


                        <?php  }
                        mysqli_close($con); ?>


                    </table>

                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>


</div>


<!-- Modal -->
<div class="modal fade" id="ScheduleModal" tabindex="-1" aria-labelledby="typesPricesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="typesPricesModalLabel" style="color: white;">Schedule Sessions
                </h5>
                <button type="button" class="btn btn-primary-close " onClick="window.location.reload();" aria-label="Close" style="color: white;"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <div class="alert alert-success mt-2 mx-2" role="alert" id="message1" style="display: none;">
                Training sessions were added successfully
            </div>

            <div class="alert alert-danger mt-2 mx-2" role="alert" id="message2" style="display: none;">
                Something went wrong when executing. Please try again later
            </div>

            <div class="modal-body add_schedule_body">

            </div>
            <div class="modal-footer">
                <input type='submit' class='btn btn-success Submit_Schedule' value='Submit'>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ViewScheduleModal" tabindex="-1" aria-labelledby="typesPricesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="typesPricesModalLabel" style="color: white;">Schedule Sessions
                </h5>
                <button type="button" class="btn btn-primary-close " class="close" data-dismiss="modal" aria-label="Close" style="color: white;"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <div class="alert alert-success mt-2 mx-2" role="alert" id="message1" style="display: none;">
                Training sessions were added successfully
            </div>

            <div class="alert alert-danger mt-2 mx-2" role="alert" id="message2" style="display: none;">
                Something went wrong when executing. Please try again later
            </div>

            <div class="modal-body view_schedule_body">

            </div>

        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        $('#menu2').tab('show')
    });
</script>

<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>


<script>
    $(document).ready(function() {


        $('.scheduleBTN').click(function() {

            var userid = $(this).data('id');

            // AJAX request
            $.ajax({
                url: 'schduleAjax.php',
                type: 'post',
                data: {
                    userid: userid
                },
                success: function(response) {
                    // Add response in Modal body
                    $('.add_schedule_body').html(response);

                    // Display Modal
                    $('#ScheduleModal').modal('show');
                }
            });
        });


        $('.ViewscheduleBTN').click(function() {

            var userid = $(this).data('id');

            // AJAX request
            $.ajax({
                url: 'ViewschduleAjax.php',
                type: 'post',
                data: {
                    userid: userid
                },
                success: function(response) {
                    //  alert(response);
                    // Add response in Modal body
                    $('.view_schedule_body').html(response);

                    // Display Modal
                    $('#ViewScheduleModal').modal('show');
                }
            });
        });



    });
</script>



<script>
    $(".Submit_Schedule").click(function() {
        $.ajax({

            method: 'POST',
            url: 'Action.php',

            data: $("#schedule_form").serialize(),
            success: function(response) {
                if (response === 'success') {
                    $("#message1").show();
                } else {
                    $("#message2").show();
                }
            }

        });
    });
</script>

<?php
require_once 'footer1.php';

?>