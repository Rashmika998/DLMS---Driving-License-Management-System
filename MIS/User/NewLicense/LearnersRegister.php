<?php
session_start();
require_once '../../includes/db.inc.php';

$l_id = $_SESSION['learners_id'];
$l_name = $_SESSION['learners_name'];
$id = $_SESSION["userid"];
$_SESSION['student'] = 0; //new
$bike = $threeWheeler = $car = $van = $truck = $bus =0;
$bike_P = $threeWheeler_P = $car_P = $van_P = $truck_P = $bus_P = 0;
$_SESSION['amount1'] =0;//new user
$_SESSION['amount2'] =0;//existing amount
$_SESSION['amount'] =0;
$bike_U = $threeWheeler_U = $car_U = $van_U = $truck_U = $bus_U =0;
$_SESSION['bike_U'] = $_SESSION['threeWheeler_U'] = $_SESSION['car_U'] = $_SESSION['van_U'] = $_SESSION['truck_U'] = $_SESSION['bus_U'] =0;
$_SESSION['bike_M'] = $_SESSION['threeWheeler_M'] = $_SESSION['car_M'] = $_SESSION['van_M'] = $_SESSION['truck_M'] = $_SESSION['bus_M'] ='';
$_SESSION['bike'] = $_SESSION['threeWheeler'] = $_SESSION['car'] = $_SESSION['van'] = $_SESSION['truck'] = $_SESSION['bus'] = 0; 

if (isset($_POST['bike'])) {
    $_SESSION['bike'] = $bike = 1;
    $_SESSION['bike_M'] = 'Bike';
}
if (isset($_POST['threeWheeler'])) {
    $_SESSION['threeWheeler'] = $threeWheeler = 1;
    $_SESSION['threeWheeler_M'] = 'Three Wheeler';
} 
if (isset($_POST['car'])) {
    $_SESSION['car'] = $car = 1;
    $_SESSION['car_M'] = 'Car';
} 
if (isset($_POST['van'])) {
    $_SESSION['van'] = $van = 1;
    $_SESSION['van_M'] = 'Van';
} 
if (isset($_POST['truck'])) {
    $_SESSION['truck'] = $truck = 1;
    $_SESSION['truck_M'] = 'Truck';
} 
if (isset($_POST['bus'])) {
    $_SESSION['bus'] = $bus = 1;
    $_SESSION['bus_M'] ='Bus';
}

//get prices 
$sql = "SELECT * FROM learners WHERE learners_id = $l_id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result))  
{
    $bike_P=$row['bike_P'];
    $threeWheeler_P=$row['threeWheeler_P'];
    $car_P=$row['car_P'];
    $van_P=$row['van_P'];
    $truck_P=$row['truck_P'];
    $bus_P=$row['bus_P'];
}

//check student
$sql = "SELECT * FROM users_learners WHERE user_id = $id AND learners_id = $l_id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result))  
{
    $_SESSION['student'] = 1; //old 
    $_SESSION['amount2'] = $row['amount'];
    if($bike == 0 && $threeWheeler == 0 && $car == 0 && $van == 0 && $truck ==0 && $bus == 0)
    {
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=select");
        exit();
    }
    if($bike == 1 && $row['bike'] == 1)
    {
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=bikeAR");
        exit();
    }
    if($threeWheeler == 1 && $row['threeWheeler'] == 1)
    {
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=threeWheelerAR");
        exit();
    }
    if($car == 1 && $row['car'] == 1)
    {
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=carAR");
        exit();
    }
    if($van == 1 && $row['van'] == 1)
    {
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=vanAR");
        exit();
    }
    if($truck == 1 && $row['truck'] == 1)
    {
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=truckAR");
        exit();
    }
    if($bus == 1 && $row['bus'] == 1)
    {
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=busAR");
        exit();
    }

    //FIND PRICE
    if($bike == 1 && $row['bike'] == 0)
    {
        $_SESSION['amount']+=$bike_P;
        $_SESSION['bike_U']=$bike_U = 1;//should update bike cols
    }
    if($threeWheeler == 1 && $row['threeWheeler'] == 0)
    {
        $_SESSION['amount']+=$threeWheeler_P;
        $_SESSION['threeWheeler_U']=$threeWheeler_U = 1;
    }
    if($car == 1 && $row['car'] == 0)
    {
        $_SESSION['amount']+=$car_P;
        $_SESSION['car_U']=$car_U = 1;
    }
    if($van == 1 && $row['van'] == 0)
    {
        $_SESSION['amount']+=$van_P;
        $_SESSION['van_U']=$van_U = 1;
    }
    if($truck == 1 && $row['truck'] == 0)
    {
        $_SESSION['amount']+=$truck_P;
        $_SESSION['truck_U']=$truck_U = 1;
    }
    if($bus == 1 && $row['bus'] == 0)
    {
        $_SESSION['amount']+=$bus_P;
        $_SESSION['bus_U']=$bus_U = 1;
    }
    $_SESSION['amount2'] += $_SESSION['amount'];
}

if($_SESSION['student']==0)//insert
{
    $_SESSION['amount1'] = ($bike * $bike_P) + ($threeWheeler * $threeWheeler_P) + ($car * $car_P) + ($van * $van_P) + ($truck * $truck_P) + ($bus * $bus_P);
    $_SESSION['amount'] = $_SESSION['amount1'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../Paypage/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-F5QTlBqZlvuBEs9LQPqc1iZv2UMxcVXezbHzomzS6Df4MZMClge/8+gXrKw2fl5ysdk4rWjR0vKS7NNkfymaBQ==" crossorigin="anonymous" defer></script>
    <title>DLMS</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <h5 class="text-dark navbar-nav">Paying Gateway</h5>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
             <li class="nav-item active"> <a class="nav-link" href="../../includes/logout.inc.php"><i class="fas fa-sign-out-alt"></i>Logout <span class="sr-only">(current)</span></a></li>
        </ul>
    </nav>
    <div class="container" >
    <div class="parent-div d-flex align-items-center justify-content-center" style="height: 60vh;">
    <div class="card text-center card border-0">
      <p>Pay the package fee to register to <?php echo $l_name?></p>
    <form action="LearnersRegisterPayment.php" method="post" id="payment-form">
            <div class="form-row">
            <input type="text" name="name" class="form-control mb-3 StripeElement StripeElement--empty" value="<?php
            echo $_SESSION['name'];
            ?>" disabled>
            <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" value="<?php
            echo $_SESSION['email'];
            ?>" disabled>
            <input type="text" name="amount" class="form-control mb-3 StripeElement StripeElement--empty" value="<?php
            echo $_SESSION['amount'];
            ?>.00 LKR" disabled>
                <div id="card-element" class="form-control">
                <!-- a Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors -->
                <div id="card-errors" role="alert"></div>
            </div>
            <div class="form-row">
                <button>Confirm Payment</button>
            </div>
        </form>
      
    </div>
    </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://js.stripe.com/v3"></script>
<script src="../Paypage/js/charge.js"></script>
</body>
</html>

