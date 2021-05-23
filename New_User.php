<?php


?>

<!DOCTYPE HTML>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <h1 class="m-3">DLMS</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> -->
                </ul>
                <i class="fa fa-2x fa-bell m-2" aria-hidden="true"></i>
                <li class="navbar-nav ml-auto m-2"><a href="#" class="nav-item nav-link"
                        style="font-size:18px">Logout</a></li>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <div class="m-3" href="#" style="color: white"><i class="fa fa-3x fa-user" aria-hidden="true"></i> Admin Panel</div>
        <a class="active" href="#home"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
        <a class="dropdown-btn"><i class="fa fa-users" aria-hidden="true"></i> Users <i class="fa fa-caret-down"></i></a>
        <div class="dropdown-container">
            <a href="#"><i class="fa fa-car" aria-hidden="true"></i> Driving Schools</a>
            <a href="#"><i class="fa fa-registered" aria-hidden="true"></i> Registered Users</a>
        </div>
        <a href="#"><i class="fa fa-id-card-o" aria-hidden="true"></i> New License</a>
        <a href="#"><i class="fa fa-address-card-o" aria-hidden="true"></i> License Renewal</a>
        <a class="dropdown-btn">Exams <i class="fa fa-caret-down"></i></a>
        <div class="dropdown-container">
            <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Exam Scheduling</a>
            <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> Exam Results</a>
        </div>
        <a href="#">Reports</a>
        <a href="#">Study Materials</a>

    </div>

    <style>
    /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
    .dropdown-container {
        display: none;
        padding-left: 12px;
    }

    .sidebar {
        margin: 0;
        padding: 0;
        width: 200px;
        position: fixed;
        height: 100%;
        overflow: auto;
        background-color: #3B444B;

    }
    /* #002366 */
    .sidebar a {
        display: block;
        color: white;
        padding: 16px;
        text-decoration: none;
    }

    .sidebar a.active {
        background-color: #1560BD;
        color: white;
    }

    .sidebar a:hover:not(.active) {
        background-color: #B2BEB5; 
        color: white;
    }
    /* 6082B6 */

    @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            float: left;
        }

        div.content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
    <script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
    </script>
</body>


</html>