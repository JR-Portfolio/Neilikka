<!DOCTYPE html>
<html>

<?php
require 'Hallinta/config.php';
require 'inc/header.php';
?>

<head>
    <title>Myymälät</title>
    <link rel="stylesheet" href="../css/neilikka.css">
    <!--Navigation start-->
    <script>
        $(function() {
            $(".navibar").load("navi.php");
        });
    </script>
</head>

<body>
    <div class="navibar"></div>
    <div class="wrapper">
        <div class="Myymalat">
            <address class="Fontti">
                <h4>Puutarhaliike Neilikka, Helsinki</h4><br>Fabianinkatu 42<br>00100 Helsinki<br>Puh.
                xx-xxxxxxx<br>Sähköposti: helsinki@puutarhaliikeneilikka.fi<p></p>Avoinna ma-ke 9-17 la 12-18
            </address>
            <address class="Fontti">
                <h4>Puutarhaliike Neilikka, Espoo</h4><br>Kivenlahdentie 10<br>01234 Espoo<br>Puh.
                xx-xxxxxxx<br>Sähköposti: espoo@puutarhaliikeneilikka.fi<p></p>Avoinna ma-ke 9-17 la 12-18
            </address>
        </div>
    </div>
    </div>
    <!--Navigation end-->
</body>

</html>