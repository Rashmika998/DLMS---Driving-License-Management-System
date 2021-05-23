<?php
require_once 'admin-header.php';

?>

<div class="right_col" role="main">

    <!-- Add Admin -->
    <div class="row justify-content-center wrapper">
        <div class="col-lg-7 bg-white p-4">
            <h4 class="text-center font-weight-bold">Administrators</h4>
            <hr class="my-3" />
            <table class="table table-striped table-hover" style="font-size: 14px;">
                <?php
                $db = mysqli_connect("localhost", "root", "", "dlms");
                $result = $db->query("SELECT admin_photo FROM admin WHERE  admin_id='" . $data['admin_id'] . "'");

                $records = mysqli_query($db, "SELECT admin_id, admin_name, admin_email,admin_photo FROM admin");

                while ($data = mysqli_fetch_array($records)) {
                ?>
                    <tr>
                        <td>
                            <!-- <img style="width: 50px;" 
                        src="data:image/png;charset=utf8;base64,
                         <?php echo base64_encode($data['admin_photo']); ?>" /> -->
                            <?php if ($result->num_rows > 0 && $data['admin_photo'] != null) { ?>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <img  style="width: 50px;" src="data:admin_photo/jpg;charset=utf8;base64,<?php echo base64_encode($row['admin_photo']); ?>" />
                                <?php } ?>
                            <?php } else { ?>

                                <img src="Header/production/images/admin.png" style="width: 50px;" alt="..." >
                            <?php } ?>

                            &nbsp;&nbsp;<?php echo $data['admin_name']; ?>

                            <span class="text-secondary" style="float: right;"><i class="fa fa-envelope" aria-hidden="true"></i>
                                <?php echo $data['admin_email'] ?></span>

                            <!-- <a href="Admin-Profile.php?admin_id=<?php echo $data['admin_id'] ?>">View
                            Profile <i class="fa fa-info-circle" aria-hidden="true"></i></a> -->
                        </td>
                    </tr>

                <?php
                }

                ?>
            </table>
        </div>
    </div>
</div>
<?php
?>

<?php

require_once 'admin-footer.php';

?>