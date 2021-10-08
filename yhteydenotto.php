<!DOCTYPE html>
<html>

<?php
require 'inc/header.php';
?>

<head>
    <title>Yhteydenotto</title>
    <link rel="stylesheet" href="css/neilikka.css">
</head>
<script>
    $(function() {
        $(".navibar").load("navi.php");
    });
</script>

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
                <label for "newsletter " class="form-check-label">Haluan tilata Puutarhaliike Neilikan uutiskirjeen
                    <input type="checkbox" name="newsletter " id="news" selected></input></label>
            </div>


            <button class="btn mt-3 btn btn-primary " type="submit">Sign in</button>

        </form>
        <!--</fieldset>-->
    </div>
</body>

</html>