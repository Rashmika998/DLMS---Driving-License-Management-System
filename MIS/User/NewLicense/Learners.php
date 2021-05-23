<?php
require_once '../../includes/db.inc.php';
require_once 'newLicenseHeader.php';
$id = $_SESSION["userid"];
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="container">
    <div class="row justify-content-center wrapper">
        <div class="col-lg-7 bg-white p-4">
            <h4 class="text-center font-weight-bold">Driving School Users(Learners)</h4>
            <hr class="my-3" />
            <div class="row justify-content-center" style="font-size: 16px;">
                <form class="d-flex" action="Learners-Search.php" method="POST">
                    <input style="width: 250px;" class="form-control me-6" name="name" placeholder="Search: ABC Learners"
                        aria-label="Search">&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>

            </div>
            <table class="table table-striped table-hover" style="font-size: 14px;">
                <?php
            $db = mysqli_connect("localhost","root","","dlms");
            $records = mysqli_query($db,"SELECT learners_id, learners_photo, learners_name FROM learners");

            while($data=mysqli_fetch_array($records)){
                // $_SESSION['learners_name'] = $data['learners_name'];
                ?>
                <tr>
                    <td>
                        <img style="width: 50px;"
                            src="data:image/png;charset=utf8;base64, <?php echo base64_encode($data['learners_photo']);?>" />
                        &nbsp;&nbsp;<?php echo "<span translate='no'>".$data['learners_name']."</span>";?>
                        <a style="float: right;"
                            href="LearnersProfile.php?learners_id=<?php echo $data['learners_id']?>">View Profile
                            <i class="fa fa-info-circle" aria-hidden="true"></i></a>
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

<?php
require_once 'footer.php';
?>