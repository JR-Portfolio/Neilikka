<!DOCTYPE html>

<html>

<?php
  require 'Hallinta/config.php';
  require 'inc/header.php';
?>

<head>
    <title>Nelikan Kotisivut</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/neilikka.css">
    <!--Below one fixed dropdown problems-->
    <script>
        $(document).ready(function() {
            $(".dropdown-toggle").dropdown();
        });
    </script>
</head>

<body>
    <!--Navigation start-->
    <nav class="navbar navbar-inverse text-center">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Neilikka</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myDrops">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                        </button>
            </div>
            <div class="collapse navbar-collapse" id="myDrops">

            <ul class="nav navbar-nav mx-auto">
                    <?php echo "<li class='active'><a href=" . URL . "/index.html>Etusivu</a></li> ?>"; ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tuotteet <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            echo "<li><a href=" . URL . "/Sisäkasvit/" . ">Sisäkasvit</a></li>";
                            echo "<li><a href=" . URL . "/Ulkokasvit>Ulkokasvit</a></li>";
                            echo "<li><a href=" . URL .  "/Valineet/>Työkalut</a></li>";
                            echo "<li><a href=" . URL .  "/Hoito/>Kasvien hoito</a></li>";
                            echo "</ul>";
                            echo "<li><a href=" . URL .  "/Myymalat.php>Myymälät</a></li>";
                            echo "<li><a href=" . URL .  "/Me.php>Tietoa meistä</a></li>";
                            echo "<li><a href=" . URL .  "/yhteydenotto.php>Ota yhteyttä</a></li>";
                            ?>
                        </ul>


                <ul class="mr-auto loggari">
                <?php "<a class='nav-link' href=http://" . URL ."/Hallinta/logout.php>Logout</a>"?>
                </ul>
                </ul>
            </div>
        </div>
    </nav>

</body>

</html>