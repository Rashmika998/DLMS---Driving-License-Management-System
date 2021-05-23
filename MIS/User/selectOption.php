<!DOCTYPE html>
<html lang="en">
<head>
<style>

.login-container{
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-form-1{
    background:#fff;
    padding: 5%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-1 h3{
    text-align: center;
    color: #333;
}
.login-form-2{
    padding: 5%;
    background: #0062cc;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-2 h3{
    text-align: center;
    color: #fff;
}
.login-container form{
    padding: 10%;
}
.btnSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    border: none;
    cursor: pointer;
}
.login-form-1 .btnSubmit{
    font-weight: 600;
    color: #fff;
    background-color: #0062cc;
}
.login-form-2 .btnSubmit{
    font-weight: 600;
    color: #0062cc;
    background-color: #fff;
}
.login-form-2 .ForgetPwd{
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}
.login-form-1 .ForgetPwd{
    color: #0062cc;
    font-weight: 600;
    text-decoration: none;
}

</style>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../includes/translate.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../includes/translate.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <title translate="no">DLMS</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <h5 class="text-dark navbar-nav"><span translate="no">DLMS</span></h5>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <i class="fas fa-sign-out-alt"></i>
             <li class="nav-item active"> <a class="nav-link" href="../includes/logout.inc.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out <span class="sr-only">(current)</span></a></li>
             <li class="nav-item"><div id="google_translate_element" style="padding-left: 35px;padding-right: 15px;"></div></li>
        </ul>
    </nav>

        <div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>New License Registration</h3>
                    <form>
                        <div class="form-group">
                            <p class="ForgetPwd">
                            To apply for new license please select this option
                            </p>
                        </div>
                        <div class="form-group">
                            <a href="NewLicense/dashboard.php" class="btn btnSubmit" style="width: fit-content;">&nbsp;&nbsp;&nbsp;Go To New License Registration&nbsp;&nbsp;&nbsp;</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 login-form-2">
                    <h3>License Renewal</h3>
                    <form>
                        <div class="form-group">
                            <p class="ForgetPwd">
                            To renew your license please select this option
                            </p>
                        </div>
                        <div class="form-group">
                            <a href="Renewal/renewaldashboard.php" class="btn btnSubmit" style="width: 250px;">&nbsp;&nbsp;&nbsp;Go To License Renewal&nbsp;&nbsp;&nbsp;</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>