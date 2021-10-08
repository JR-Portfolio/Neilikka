<!DOCTYPE html>
<html>

<?php
    require 'Hallinta/config.php';
    require 'inc/header.php';
?>

<head>
    <title>Ulkokasvit</title>
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
    <h3 class="otsikko">Ulkokasvit</h3>
    <div class="products">
        <div class="content">
            <img src="kukka1.jpg" width="110px" height="90px" alt="Orkidea">
            <div class="kuvaus">Orkidea</div>
        </div>
        <div class="content">
            <img src="Kukka2.jpg" width="110px" height="90px" alt="Oranssi ruusu">
            <div class="kuvaus">Oranssi ruusu</div>
        </div>
        <div class="content">
            <img src="Kukka3.jpg" width="110px" height="90px" alt="Vaaleanpunainen ruusu">
            <div class="kuvaus">Vaaleanpunainen ruusu</div>
        </div>
    </div>
</body>

</html>