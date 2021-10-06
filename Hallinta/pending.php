<?php include('./user_activation.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>User Verification</title>

    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="jumbotron text-center" style = "margin-top:100px;">
        <div class="col-12 mb-5 text-center" >
            <h1 class="display-9">Email verification on it's way,<br>pls check and activate your account.</h1>
            <script>
                  setTimeout(() => {window.location.href = "http://localhost/Neilikka/Hallinta/login.php";}, 2500);
              </script>
        </div>
    </div>

</body>
</html>