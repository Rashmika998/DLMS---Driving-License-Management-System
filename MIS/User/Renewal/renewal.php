
<?php
require_once 'renewalHeader.php';
require_once 'db.inc.php';

?>

<?php
if (!isset($_SESSION["useruid"])) {
    header('location: ../User/login.php');
}
?>


           <!-- page content -->
<div class="right_col" role="main">
<div class="row-sm-6">
  <div class="col-sm-6">
  <div class="card-header">
 
  <h2>Profile Details
     <a href="" data-toggle="modal" data-target="#editinfoModal"><i class="fa fa-edit pull-right"></i></a>

     <!-- Modal -->
     
     <div class="modal fade" id="editinfoModal" tabindex="-1" aria-labelledby="editinfoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h6 class="modal-title text-light" id="editinfoModalLabel">Edit Profile Info</h6> 
        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form action="RenewalEditUser.php" method="post">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name" value="<?php 
                                        $id = $_SESSION["userid"];
                                        $sql = "SELECT * FROM users WHERE user_id = $id;";
                                        $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["full_name"];}
                                    ?>" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label>Gender</label>
                                <select class="custom-select" name="gender" >
                                <option selected value="<?php 
                                        $id = $_SESSION["userid"];
                                        $sql = "SELECT * FROM users WHERE user_id = $id;";
                                        $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["gender"];}
                                    ?>">(
                                        <?php 
                                        $id = $_SESSION["userid"];
                                        $sql = "SELECT * FROM users WHERE user_id = $id;";
                                        $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["gender"];}
                                    ?>
                                        
                                        ) Click to Change</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Username</label>

                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@</div>
                                    </div>
                                    <input type="text" class="form-control" name="uid" value="<?php 
                                        $id = $_SESSION["userid"];
                                        $sql = "SELECT * FROM users WHERE user_id = $id;";
                                        $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["user_name"];}
                                    ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label>Contact No</label>
                            <input type="text" class="form-control" name="contactNo" value="<?php 
                                        $id = $_SESSION["userid"];
                                        $sql = "SELECT * FROM users WHERE user_id = $id;";
                                        $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["contact_no"];}
                                    ?>" required>
                            </div>

                            <div class="form-group col-md-6">
                            <label>NIC No</label>
                            <input type="text" class="form-control" name="NICno" value="<?php 
                                        $id = $_SESSION["userid"];
                                        $sql = "SELECT * FROM users WHERE user_id = $id;";
                                        $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["nic"];}
                                    ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php 
                                        $id = $_SESSION["userid"];
                                        $sql = "SELECT * FROM users WHERE user_id = $id;";
                                        $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row["user_email"];}
                                    ?>" required>   
                        </div>

                        <div class="form-group row justify-content-center">
                          <button class="btn btn-dark" input type="submit " name="submit">Save Changes</button>                                
                      </div>
                      </form>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>   
             
 
  </div>
  
  
      <div class="card-body">
       
        <table class="table table-borderless">
        <tr>
        <th> User ID </th>
        <th> <?php $id =$_SESSION["userid"] ;
        $sql="SELECT * FROM users WHERE user_id=$id;";
        $result = mysqli_query($link,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {echo $row["user_id"];    }
        
          ?></th>
        </tr>

        <tr>
        <td> Full Name</td>
        <td> 
        <?php $id =$_SESSION["userid"] ;
        $sql="SELECT * FROM users WHERE user_id=$id;";
        $result = mysqli_query($link,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {echo $row["user_name"]; }?>
        </td>
       
       <tr>
       <td> User Name</td>
        <td> 
        <?php $id =$_SESSION["userid"] ;
        $sql="SELECT * FROM users WHERE user_id=$id;";
        $result = mysqli_query($link,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {echo $row["full_name"]; }?>
        </td>
      </tr>
      
      <tr>
       <td> Email</td>
        <td> 
        <?php $id =$_SESSION["userid"] ;
        $sql="SELECT * FROM users WHERE user_id=$id;";
        $result = mysqli_query($link,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {echo $row["user_email"]; }?>
        </td>
      </tr>

      <tr>
       <td> NIC Number</td>
        <td> 
        <?php $id =$_SESSION["userid"] ;
        $sql="SELECT * FROM users WHERE user_id=$id;";
        $result = mysqli_query($link,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {echo $row["nic"]; }?>
        </td>
      </tr>

      <tr>
       <td> Contact Number</td>
        <td> 
        <?php $id =$_SESSION["userid"] ;
        $sql="SELECT * FROM users WHERE user_id=$id;";
        $result = mysqli_query($link,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {echo $row["contact_no"]; }?>
        </td>
      </tr>

      <tr>
       <td> Gender</td>
        <td> 
        <?php $id =$_SESSION["userid"] ;
        $sql="SELECT * FROM users WHERE user_id=$id;";
        $result = mysqli_query($link,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {echo $row["gender"]; }?>
        </td>
      </tr>
      
        </table>
      
      </div>
      <div class="card-footer text-right">
  <a href="#" data-toggle="modal" data-target="#editinfoModal"> Click here to change password </a>
  </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div>
</div>




<?php require_once 'footer.php';

?>
    

       