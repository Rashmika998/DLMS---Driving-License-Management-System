<?php
session_start();
$id = $_SESSION["userid"];
require_once '../../vendor/autoload.php';
require_once '../../includes/db.inc.php';
require_once '../../includes/functions.inc.php';

\Stripe\Stripe::setApiKey('sk_test_51I2wZ8EG7KGMl4QwyFek7A5Tdi5HmY1zhvfDZXF3tOg5nmEthyYa0TiQqhU36ElpmdQYHdrvRC4ywfzOJZQEWi1p00U56ikRwn');

// Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$token = $POST['stripeToken'];
$amount = $_SESSION['amount'];
$email=$_SESSION['email'];
$name=$_SESSION['name'];
$tot=0;
$attempt = 0;
$NewResult='N/A';
$Description ='';

date_default_timezone_set('Asia/Colombo');
$dt = date('Y-m-d H:i:s');
$paid="Yes";


    if($_SESSION['update']==1)
    {
        $sql = "INSERT INTO renewal_payment (user_id, token, amount,paid,paid_at) VALUES (?,?,?,?,?);";
        $stmt = mysqli_stmt_init($link);

        if (!mysqli_stmt_prepare($stmt,$sql)) {

           // $e1=mysqli_error($link);
           // echo $e1;
            header("location: ../Renewal/RenewalRegistration.php?error=stmtfailed");
           exit();
        }
        mysqli_stmt_bind_param($stmt,"isiss",$id ,$token,$amount,$paid,$dt);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $subject= "E-License Renewal Payment Confirmation";
        $body= "Hello " .$name. "! <br>We have received your renewal payment.<br><br>
        <table class='0 border'>
        <tr>
            <td>Voucher reference no</td>
            <td>:</td>
            <td>".$token."</td>
        </tr> 
        <tr>
            <td>Payment method</td>
            <td>:</td>
            <td>Online</td>
        </tr> 
        <tr>
            <td>Amount:  </td>
            <td>:</td>
            <td>".$amount.".00 LKR</td>
        </tr> 
        <tr>
            <td>Date & Time:  </td>
            <td>:</td>
            <td>".$dt."</td>
        </tr> 
        </table><br><br>Thank you";

        $sql = "INSERT INTO payments (token,user_id,amount,paid_at,Description) VALUES (?,?,?,?,?);";
        $stmt = mysqli_stmt_init($link);

        if (!mysqli_stmt_prepare($stmt,$sql)) {
           // $e=mysqli_error($link);
           // echo $e;
          header("location:  ../Renewal/RenewalRegistration.php?error=stmtfailed");
           exit();
        }
        $Description ='Renewal Fee';
        mysqli_stmt_bind_param($stmt,"sssss",$token,$id ,$amount, $dt,$Description);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        sendEmail($email, $name, $body, $subject);

        header("Location: ../Renewal/RenewalRegistration.php?error=RenewalPaid");
        exit();
    }

?>
