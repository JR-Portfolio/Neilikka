<!DOCTYPE html>
<html>

<?php
require 'Hallinta/config.php';
require 'inc/header.php';
?>

<head>
    <title>Välineet</title>
    <link rel="stylesheet" href="../css/neilikka.css">
    <!--Navigation start-->
    <script>
        $(function() {
            $(".navibar").load("../navi.php");
        });
    </script>
</head>

<body>

    <div class="navibar"></div>

    <h3 class="otsikko">Puutarhavälineet</h3>
    <div class="products">
        <div class="content">
            <img src="valine1.jpg" width="110px" height="90px" alt="Harava">
            <div class="kuvaus">Harava, 30 euroa</div>
        </div>
        <div class="content">
            <img src="valine2.jpg" width="110px" height="90px" alt="Tonkija">
            <div class="kuvaus">Tonkija, 12 euroa</div>
        </div>
        <div class="content">
            <img src="valine3.jpg" width="110px" height="90px" alt="Puutarhasetti">
            <div class="kuvaus">Puutarhasetti, 20 euroa</div>
        </div>
        <div class="content">
            <img src="valine4.jpg" width="110px" height="90px" alt="Saha">
            <div class="kuvaus">Saha, 22 euroa</div>
        </div>
    </div>
</body>

</html>