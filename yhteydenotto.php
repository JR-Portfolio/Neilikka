<!DOCTYPE html>
<html>

<!--
<head>
    <title>Tietoa meistä</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css/neilikka.css">-->
    <!--Navigation start-->
    <!--<script>
        $(function() {
            $(".navibar").load("navi.html");
        });
    </script>
</head>-->
<?php
require 'inc/header.php';
?>

<body>
    <div class="navibar"></div>

    <div class="container">
        <!--<fieldset class="scheduler-border">
        <legend class="scheduler-border">Yhteydenotto</legend>-->
        <h3 class="my-5">
            Yhteydenotto
        </h3>
        <span class="sm">Puhelimitse myymälöihin, asiakaspalvelu@puutarhaliikeneilikka.fi
        <br> tai alla olevalla lomakkeella</span>

        <form>
            <div class=" form-group my-2 ">
                <label for="nimi ">Nimi:</label>
                <input class="form-control col-sm-2 " type="text " name="nimi " required>
            </div>

            <div class="form-group my-2 ">
                <label for="email ">Sähköposti:</label>
                <input class="form-control col-sm-3 " type="email " id="email " name="email " pattern="[a-z0-9._%+-]+@[a-z0-9.]+\.[a-z]{2,}$ " placeholder="ex. firstname.lastname@domain.fi " required>
            </div>

            <div class="form-group my-2">
                <label for="yhteydenotto ">Yhteydenoton syy:</label>
                <select class="form-select " id="autoSizingSelect " name="yhteydenpito ">
                        <option value="Ruusuja " selected>Ruusuja</option>
                        <option value="muu ">Risuja</option>
                    </select>
            </div>

            <div class="form-group my-2 ">
                <label for="viesti ">Viesti:</label>
                <textarea class="form-control col-sm-4 " rows="5 " columns="80 " name="viesti " required></textarea>
            </div>


            <div class="form-check my-2">
                <input type="checkbox" name="newsletter " id="news" selected></input>
                <label for "newsletter " class="form-check-label">Haluan tilata Puutarhaliike Neilikan uutiskirjeen</label>
            </div>

            <button class="btn mt-3 btn btn-primary " type="submit">Sign in</button>

        </form>
        <!--</fieldset>-->
    </div>
</body>

</html>