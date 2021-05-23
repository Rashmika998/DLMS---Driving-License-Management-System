<?php
include "config.php";

$userid=0;
if(isset($_POST['userid'])){
   $userid = mysqli_real_escape_string($link,$_POST['userid']);
}


$sql = "select * from users_learners where user_id=$userid AND scheduled=0";
$result = mysqli_query($link,$sql);

$response = "<form id='schedule_form'>";
while( $row = mysqli_fetch_array($result) ){
 $id = $row['user_id'];
 $response.='<input type="text" value='.$id.' name="user_id" style="display:none"> ';
 
 if ($row['bike'] == 1){
     $response.='<label><b>Bike</b> <i class="fa fa-motorcycle" aria-hidden="true"></i></label>';
     $response.='<br><b>Session 01</b><br><input type="datetime-local" class="form-control" name="session1_Bike" required>';
     $response.='<br><b>Session 02</b><br><input type="datetime-local" class="form-control" name="session2_Bike" required>';

 }
 
 if ($row['threeWheeler'] == 1){
     $response.='<br><label><b>Three Wheeler</b> <img style="width: 20px;" src="https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png" /></label>
     ';
     $response.='<br><b>Session 01</b><br><input type="datetime-local" class="form-control" name="session1_TW" required>';
     $response.='<br><b>Session 02</b><br><input type="datetime-local" class="form-control" name="session2_TW" required>';
 }
 if ($row['car'] == 1){
     $response.=' <label><b>Car </b><i class="fa fa-car" aria-hidden="true"></i></label>
     ';
     $response.='<br><b>Session 01</b><br><input type="datetime-local" class="form-control" name="session1_Car" required>';
     $response.='<br><b>Session 02</b><br><input type="datetime-local" class="form-control" name="session2_Car" required>';
 }
 if ($row['van'] == 1){
     $response.='<br><label><b>Van </b><img style="width: 20px;" src="https://img.icons8.com/ios-filled/50/000000/van.png" /></label>
     ';
     $response.='<br><b>Session 01</b><br><input type="datetime-local" class="form-control" name="session1_Van" required>';
     $response.='<br><b>Session 02</b><br><input type="datetime-local" class="form-control" name="session2_Van" required>';
 }
 if ($row['truck'] == 1){
     $response.=' <br><label><b>Truck</b> <i class="fa fa-truck" aria-hidden="true"></i></label>
     ';
     $response.='<br><b>Session 01</b><br><input type="datetime-local" class="form-control" name="session1_Truck" required>';
     $response.='<br><b>Session 02</b><br><input type="datetime-local" class="form-control" name="session2_Truck" required>';
 }
 if ($row['bus'] == 1){
     $response.='  <br>  <label><b>Bus</b> <i class="fa fa-bus" aria-hidden="true"></i></label>
     ';
     $response.='<br><b>Session 01</b><br><input type="datetime-local" class="form-control" name="session1_Bus" required>';
     $response.='<br><b>Session 02</b><br><input type="datetime-local" class="form-control" name="session2_Bus" required>';
 }





}

$response.= ".</form>";
echo $response;
exit;


