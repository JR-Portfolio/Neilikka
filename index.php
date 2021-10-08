<!DOCTYPE html>

<html>

<?php
    require 'Hallinta/config.php';
    require 'inc/header.php';
?>
<head>
    <title>Nelikan Kotisivut</title>
    <link rel="stylesheet" href="css/neilikka.css">
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
        <div class="blocktext">

            <p> Tervetuloa Puutarhaliike Neilikan kotisivuille! Meiltä löydät sekä sisä- että ulkokasvit ja kaiken tarvitsemasi kasvien hoitoon. </p>
            <p></p>
            <h4 class="otsikko"> Uutisia </h4>
            <p> 2.1.2016 Hyvää uutta vuotta! Uuden vuoden kunniaksi myymälöissämme upeita tarjouksia. </p>
            <p> 14.12.2015 Joulukukat edullisesti meiltä. Myymälöissämme myös kattava ja edullinen valikoima joulukuusia. </p>
            <p> 1.9.2015 Nyt on hyvä aika aloittaa puutarhan valmistelu talven lepokautta varten. Meiltä löydät kaikki työkalut ja tarvikkeet. </p>
        </div>
    </div>
    <div class="footer-bottom">
        <p id="foot"></p>
        <footer>
            <script>
                fetch('http://worldclockapi.com/api/json/utc/now')
                    .then(data => data.json())
                    .then(d =>
                        document.getElementById('foot').innerHTML = "Webmaster Jouni Riimala. Päivitetty " + (new Date(d.currentDateTime))
                    )
            </script>
        </footer>
    </div>

</body>

</html>