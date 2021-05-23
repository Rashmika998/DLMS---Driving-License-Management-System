<?php
include "config.php";

$userid=0;
if(isset($_POST['userid'])){
   $userid = mysqli_real_escape_string($link,$_POST['userid']);
}


$sql = "select * from users_learners where user_id=$userid AND scheduled=1";
$result = mysqli_query($link,$sql);

$response = "<form id='schedule_form'>";
while( $row = mysqli_fetch_array($result) ){
 $id = $row['user_id'];
 $response.='<input type="text" value='.$id.' name="user_id" style="display:none"> ';
 
 if ($row['bike'] == 1){
     $response.='<label><b>Bike</b> <i class="fa fa-motorcycle" aria-hidden="true"></i></label>';
     $response.='<br><b>Session 01</b><br><input type="datetime" value="'.$row['bike_s1'].'"    class="form-control" name="session1_Bike" readonly>';
     $response.='<br><b>Session 02</b><br><input  value="'.$row['bike_s2'].'"  class="form-control" name="session2_Bike" readonly>';

 }
 
 if ($row['threeWheeler'] == 1){
     $response.='<br><label><b>Three Wheeler <img style="width: 20px;" src="https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png" /></label>
     ';
     $response.='<br><b>Session 01</b><br><input  value="'.$row['threeWheeler_s1'].'"  class="form-control" name="session1_TW" readonly>';
     $response.='<br><b>Session 02</b><br><input  value="'.$row['threeWheeler_s2'].'"  class="form-control" name="session2_TW" readonly>';
 }
 if ($row['car'] == 1){
     $response.=' <label><b>Car </b><i class="fa fa-car" aria-hidden="true"></i></label>
     ';
     $response.='<br><b>Session 01</b><br><input  class="form-control" value="'.$row['car_s1'].'"  name="session1_Car" readonly>';
     $response.='<br><b>Session 02</b><br><input  class="form-control" value="'.$row['car_s2'].'"  name="session2_Car" readonly>';
 }
 if ($row['van'] == 1){
     $response.='<br><label><b>Van </b><img style="width: 20px;" src="https://img.icons8.com/ios-filled/50/000000/van.png" /></label>
     ';
     $response.='<br><b>Session 01</b><br><input  class="form-control" value="'.$row['van_s1'].'"   name="session1_Van" readonly>';
     $response.='<br><b>Session 02</b><br><input  class="form-control" value="'.$row['van_s2'].'"  name="session2_Van" readonly>';
 }
 if ($row['truck'] == 1){
     $response.=' <br><label><b>Truck</b> <i class="fa fa-truck" aria-hidden="true"></i></label>
     ';
     $response.='<br><b>Session 01</b><br><input  class="form-control" value="'.$row['truck_s1'].'"  name="session1_Truck" readonly>';
     $response.='<br><b>Session 02</b><br><input  class="form-control" value="'.$row['truck_s2'].'"   name="session2_Truck" readonly>';
 }
 if ($row['bus'] == 1){
     $response.='  <br>  <label><b>Bus</b> <i class="fa fa-bus" aria-hidden="true"></i></label>
     ';
     $response.='<br><b>Session 01</b><br><input  class="form-control" value="'.$row['bus_s1'].'"  name="session1_Bus" readonly>';
     $response.='<br><b>Session 02</b><br><input  class="form-control" value="'.$row['bus_s2'].'"  name="session2_Bus" readonly>';
 }





}

$response.= ".</form>";
echo $response;
exit;


