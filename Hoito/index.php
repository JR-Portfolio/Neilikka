<?php
// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>


<html>

<head>
    <title>Nelikan Kotisivut</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/neilikka.css">
    <!--Navigation start-->
    <script>
        $(function() {
            $(".navibar").load("../navi.html");
        });
    </script>
</head>

<body>
    <!--Navigation start-->
    <div class="navibar"></div>
    <h3 class="otsikko">Hoito</h3>
    <div class="products">
        <div class="content">
            <img src="hoito1.jpg" width="110px" height="90px" alt="Teline">
            <div class="kuvaus">Teline, 30 euroa</div>
        </div>
        <div class="content">
            <img src="hoito2.jpg" width="110px" height="90px" alt="Tukikeppi">
            <div class="kuvaus">Tukikeppi, 10 euroa</div>
        </div>
        <div class="content">
            <img src="hoito3.jpg" width="110px" height="90px" alt="Kasvusuoja">
            <div class="kuvaus">Kasvusuoja, 55 euroa</div>
        </div>
        <div class="content">
            <img src="hoito4.jpg" width="110px" height="90px" alt="Teline 2">
            <div class="kuvaus">Teline 2, 40 euroa</div>
        </div>
        <div class="content">
            <img src="hoito5.jpg" width="110px" height="90px" alt="Kasvupeite">
            <div class="kuvaus">Kasvupeite, 60 euroa</div>
        </div>
    </div>
</body>

</html>