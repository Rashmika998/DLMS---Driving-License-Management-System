<?php

?>

<!DOCTYPE HTML>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Add Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<body>
    <div class="container m-3" >
    <h2>Add Administrator</h2>
    <p>Please fill this form to create an admin account.</p>
        <form>
            <div class="mb-3">
                <label for="admin_name" class="form-label">Admin Full Name</label>
                <input name="admin_name" type="text" class="form-control" id="admin_name" placeholder="Enter the full name">
            </div>
            <div class="mb-3">
                <label for="admin_username" class="form-label">Admin Username</label>
                <input name="admin_username" type="text" class="form-control" id="admin_username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input id="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Ex: abc@gmail.com">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-outline-success" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

        </form>
        <div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
                integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
                integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG"
                crossorigin="anonymous">
            </script>
</body>

</html>