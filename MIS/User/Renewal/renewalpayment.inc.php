<?php
session_start();
require_once '../../includes/db.inc.php';
require_once '../../vendor/autoload.php';
require_once '../../includes/functions.inc.php';

$id = $_SESSION["userid"];
$email=$_SESSION['email'];
$name=$_SESSION['name'];

\Stripe\Stripe::setApiKey('sk_test_51I2wZ8EG7KGMl4QwyFek7A5Tdi5HmY1zhvfDZXF3tOg5nmEthyYa0TiQqhU36ElpmdQYHdrvRC4ywfzOJZQEWi1p00U56ikRwn');
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
$token = $POST['stripeToken'];
date_default_timezone_set('Asia/Colombo');
$dt = date('Y-m-d H:i:s');

$A1 = $A = $B1 = $B = $C1 = $C = $CE = $D1 = $D = $DE = $G1 = $G =$J = '';
$resultA1 = $resultA = $resultB1 = $resultB = $resultC1 = $resultC = $resultCE = $resultD1 = $resultD = $resultDE = $resultG1 = $resultG = $resultJ = '';
$attemptA1 = $attemptA = $attemptB1 = $attemptB = $attemptC1 = $attemptC = $attemptCE = $attemptD1 = $attemptD = $attemptDE = $attemptG1 = $attemptG = $attemptJ = 0;


$sql = "SELECT * FROM trial_exam, trial_result WHERE trial_result.user_id = $id AND trial_exam.user_id = $id ;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result))  
{
    $resultA1 = $row['resultA1'];
    $resultA = $row['resultA'];
    $resultB1 = $row['resultB1'];
    $resultB = $row['resultB'];
    $resultC1 = $row['resultC1'];
    $resultC = $row['resultC'];
    $resultCE = $row['resultCE'];
    $resultD1 = $row['resultD1'];
    $resultD = $row['resultD'];
    $resultDE = $row['resultDE'];
    $resultG1 = $row['resultG1'];
    $resultG = $row['resultG'];
    $resultJ = $row['resultJ'];

    $attemptA1 = $row['attemptA1'];
    $attemptA = $row['attemptA'];
    $attemptB1 = $row['attemptB1'];
    $attemptB = $row['attemptB']; 
    $attemptC1 = $row['attemptC1'];
    $attemptC = $row['attemptC'];
    $attemptCE = $row['attemptCE'];
    $attemptD1 = $row['attemptD1'];
    $attemptD = $row['attemptD'];
    $attemptDE = $row['attemptDE'];
    $attemptG1 = $row['attemptG1'];
    $attemptG = $row['attemptG'];
    $attemptJ = $row['attemptJ'];


    if($row['resultA1'] == 'Fail' && $row['attemptA1'] < 3)
    {
        $resultA1='';
        $attemptA1++;
        $A1=' A1 ';
    }
    if($row['resultA'] == 'Fail' && $row['attemptA'] < 3)
    {
        $resultA='';
        $attemptA++;
        $A = ' A ';
    }
    if($row['resultB1'] == 'Fail' && $row['attemptB1'] < 3)
    {
        $resultB1='';
        $attemptB1++;
        $B1 =' B1 ';
    }
    if($row['resultB'] == 'Fail' && $row['attemptB'] < 3)
    {
        $resultB='';
        $attemptB++;
        $B = ' B ';
    }
    if($row['resultC1'] == 'Fail' && $row['attemptC1'] < 3)
    {
        $resultC1='';
        $attemptC1++;
        $C1 = ' C1 ';
    }
    if($row['resultC'] == 'Fail' && $row['attemptC'] < 3)
    {
        $resultC='';
        $attemptC++;
        $C = ' C ';
    }
    if($row['resultCE'] == 'Fail' && $row['attemptCE'] < 3)
    {
        $resultCE='';
        $attemptCE++;
        $CE = ' CE ';
    }
    if($row['resultD1'] == 'Fail' && $row['attemptD1'] < 3)
    {
        $resultD1='';
        $attemptD1++;
        $D1 = ' D1 ';
    }
    if($row['resultD'] == 'Fail' && $row['attemptD'] < 3)
    {
        $resultD='';
        $attemptD++;
        $D = ' D ';
    }
    if($row['resultDE'] == 'Fail' && $row['attemptDE'] < 3)
    {
        $resultDE='';
        $attemptDE++;
        $DE = ' DE ';
    }
    if($row['resultG1'] == 'Fail' && $row['attemptG1'] < 3)
    {
        $resultG1='';
        $attemptG1++;
        $G1 = ' G1 ';
    }
    if($row['resultG'] == 'Fail' && $row['attemptG'] < 3)
    {
        $resultG='';
        $attemptG++;
        $G = ' G ';
    }
    if($row['resultJ'] == 'Fail' && $row['attemptJ'] < 3)
    {
        $resultJ='';
        $attemptJ++;
        $J = ' J ';
    }
}

$sql = "UPDATE trial_result SET  

resultA1 = ?, resultA = ?, resultB1 = ?, resultB = ?, resultC1 = ?, resultC = ?, resultCE = ?, resultD1 = ?, resultD = ?, resultDE = ?,
resultG1 = ?, resultG = ?, resultJ = ?,

attemptA1 = ?, attemptA = ?, attemptB1 = ?, attemptB = ?, attemptC1 = ?, attemptC = ?, attemptCE = ?, attemptD1 = ?, attemptD = ?, attemptDE = ?,
attemptG1 = ?, attemptG = ?, attemptJ = ?,

paid =?

WHERE user_id = ?;";
$stmt = mysqli_stmt_init($link);
    
if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("location: trial.php?error=stmtfailed");
    exit();
}
$paid = 'Yes';
mysqli_stmt_bind_param($stmt,"ssssssssssssssssssssssssssss",
$resultA1,$resultA,$resultB1,$resultB,$resultC1,$resultC,$resultCE,$resultD1,$resultD,$resultDE,$resultG1,$resultG,$resultJ,
$attemptA1,$attemptA,$attemptB1,$attemptB,$attemptC1,$attemptC,$attemptCE,$attemptD1,$attemptD,$attemptDE,$attemptG1,$attemptG,$attemptJ,
$paid,$id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);


$sql = "INSERT INTO payments (token,user_id,amount,paid_at,Description) VALUES (?,?,?,?,?);";
$stmt = mysqli_stmt_init($link);

if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("location: trial.php?error=stmtfailed");
    exit();
}

$Description ="Re-Register for practical exam - ".$A1.$A.$B1.$B.$C1.$C.$CE.$D1.$D.$DE.$G1.$G.$J;
        
mysqli_stmt_bind_param($stmt,"sssss",$token,$id ,$_SESSION['trial'], $dt,$Description);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$subject = 'E-License Re-Register for Practical Exam Payment Confirmation';

$body= "Hello " .$name. "! <br>We have received your payment. Practical Exam details will be posted onto your DLMS page.<br><br>
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
            <td>".$_SESSION['trial'].".00 LKR</td>
        </tr> 
        <tr>
            <td>Re-applied types of practical exam(s):  </td>
            <td>:</td>
            <td>".$A1.$A.$B1.$B.$C1.$C.$CE.$D1.$D.$DE.$G1.$G.$J."</td>
        </tr> 
        <tr>
            <td>Date & Time:  </td>
            <td>:</td>
            <td>".$dt."</td>
        </tr> 
        </table><br><br>Thank you";

sendEmail($email, $name, $body, $subject);

header("Location: trial.php?error=none");
exit();

