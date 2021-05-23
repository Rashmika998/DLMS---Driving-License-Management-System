<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $resultA1 = $resultA = $resultB1 = $resultB = $resultC1 = $resultC = $resultCE = $resultD1 = $resultD = $resultDE = 
    $resultG1 = $resultG = $resultJ = NULL;

    $uid = $_POST['uid'];
    $attempt = $_SESSION['attempt'];

    if(isset($_POST['resultA1']))
    $resultA1 = $_POST['resultA1'];

    if(isset($_POST['resultA']))
    $resultA = $_POST['resultA'];

    if(isset($_POST['resultB1']))
    $resultB1 = $_POST['resultB1'];

    if(isset($_POST['resultB']))
    $resultB = $_POST['resultB'];

    if(isset($_POST['resultC1']))
    $resultC1 = $_POST['resultC1'];

    if(isset($_POST['resultC']))
    $resultC = $_POST['resultC'];

    if(isset($_POST['resultCE']))
    $resultCE = $_POST['resultCE'];

    if(isset($_POST['resultD1']))
    $resultD1 = $_POST['resultD1'];

    if(isset($_POST['resultD']))
    $resultD = $_POST['resultD'];

    if(isset($_POST['resultDE']))
    $resultDE = $_POST['resultDE'];

    if(isset($_POST['resultG1']))
    $resultG1 = $_POST['resultG1'];

    if(isset($_POST['resultG']))
    $resultG = $_POST['resultG'];

    if(isset($_POST['resultJ']))
    $resultJ = $_POST['resultJ'];

    // Check input errors before inserting in database
    if (empty($name_err) && empty($username_err) && empty($location_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO trial_result (user_id, resultA1, resultA, resultB1, resultB, resultC1, resultC, resultCE,
        resultD1, resultD, resultDE, resultG1, resultG, resultJ) VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            if ($stmt->bind_param("isssssssssssss",$param_uid, $param_resultA1, $param_resultA, $param_resultB1,
            $param_resultB, $param_resultC1, $param_resultC, $param_resultCE, $param_resultD1, $param_resultD, $param_resultDE,
            $param_resultG1, $param_resultG, $param_resultJ))

            // Set parameters
            $param_uid = $uid;
            $param_resultA1 = $resultA1;
            $param_resultA = $resultA;
            $param_resultB1 = $resultB1;
            $param_resultB = $resultB;
            $param_resultC1 = $resultC1;
            $param_resultC = $resultC;
            $param_resultCE = $resultCE;
            $param_resultD1 = $resultD1;
            $param_resultD = $resultD;
            $param_resultDE = $resultDE;
            $param_resultG1 = $resultG1;
            $param_resultG = $resultG;
            $param_resultJ = $resultJ;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if($resultA1 == 'Fail' || $resultA == 'Fail' || $resultB1 == 'Fail' || $resultB == 'Fail' || $resultC1 == 'Fail'
                 || $resultC == 'Fail' || $resultCE == 'Fail' || $resultD1 == 'Fail' || $resultD == 'Fail' || $resultDE == 'Fail'
                  || $resultG1 == 'Fail' || $resultG == 'Fail' || $resultG1 == 'Fail'){
                    $update = mysqli_query($link, "UPDATE trial_exam SET overall = 'Fail' WHERE user_id = '".$uid."'");

                    $update_pay = mysqli_query($link, "UPDATE trial_result SET paid = 'No' WHERE user_id = '".$uid."'");
                  }

                else
                $update = mysqli_query($link, "UPDATE trial_exam SET overall = 'Pass' WHERE user_id = '".$uid."'");
                
                   header("Location: Trial-Results-Added.php");
                   exit();
                
            } else {

                echo ("Something went wrong when executing. Please try again later.".mysqli_error($link));
            }

            // Close statement
            $stmt->close();
        }
        else
        echo ("Something went wrong when preparing. Please try again later.".mysqli_error($link));
    }

    // Close connection
    $link->close();
}

?>