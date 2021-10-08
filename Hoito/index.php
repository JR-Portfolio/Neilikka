<!DOCTYPE html>

<html>

<?php
    require 'Hallinta/config.php';
    require 'inc/header.php';
?>

<head>
    <title>Hoito</title>
    <link rel="stylesheet" href="../css/neilikka.css">
    <!--Navigation start-->
    <script>
        $(function() {
            $(".navibar").load("../navi.php");
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