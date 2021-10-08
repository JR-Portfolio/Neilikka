<!DOCTYPE html>
<html>


<?php
require 'Hallinta/config.php';
require 'inc/header.php';
?>

<head>
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
                    <?php echo "<li class='active'><a href=" . AURL . "/index.php>Etusivu</a></li> ?>"; ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tuotteet <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            echo "<li><a href=" . AURL . "/Sisäkasvit/" . ">Sisäkasvit</a></li>";
                            echo "<li><a href=" . AURL . "/Ulkokasvit>Ulkokasvit</a></li>";
                            echo "<li><a href=" . AURL .  "/Valineet/>Työkalut</a></li>";
                            echo "<li><a href=" . AURL .  "/Hoito/>Kasvien hoito</a></li>";
                            echo "</ul>";
                            echo "<li><a href=" . AURL .  "/Myymalat.html>Myymälät</a></li>";
                            echo "<li><a href=" . AURL .  "/Me.html>Tietoa meistä</a></li>";
                            echo "<li><a href=" . AURL .  "/yhteydenotto.php>Ota yhteyttä</a></li>";
                            ?>
                        </ul>


                        <ul class="mr-auto loggari">
                            <?php
                            echo "<a class='nav-link' href='AURL/Hallinta/login.php'>Login /</a>";
                            echo "<a class='nav-link' href='AURL/Hallinta/register.php'> Register</a>";
                            ?>
                        </ul>
                </ul>
            </div>
        </div>
    </nav>
    <!--Navigation end-->

    <!--

.nav-top-right {
  align-items: flex-end;
}


    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ AURL('/login') }}">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ AURL('/register') }}">Register</a>
      </li>
    </ul>
-->



</body>

</html>