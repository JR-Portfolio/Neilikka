<!DOCTYPE html>
<html>

<?php
    require '../Hallinta/config.php';
    require '../inc/header.php';
?>

<head>
    <title>Nelikan Kotisivut</title>
    <link rel="stylesheet" href="../css/neilikka.css">
    <script>
        $(function() {
            $(".navibar").load("../navi.php");
        });
    </script>
</head>

<body>
    <p id="tilanne">Ostoskorissa </p><button name="checkout" class="checkout" onclick="checkout()">Checkout</button>
    </p>
    <script>
        let i = 0;
        let summa = 0;
        var result = 0;

        function koriin(tuote) {
            let t = parseInt(tuote.value);
            console.log("Hinta: " + t);
            result += t;
            console.log("Summa " + result);
            i++;
            document.getElementById("tilanne").innerHTML = "Kokonais summa: " + result + "<br>" + "Tuotteita: " + i;
            console.log("local result:" + result);
            return result;
        }
        //No need to pass result as a parameter as value is already global value.
        function checkout() {
            console.log(result);
            alert("Maksoit juuri " + result + " euroa tililleni, bye");
        }
    </script>
    <div class="navibar"></div>

    <h3 class="otsikko">Sisäkasvit</h3>
    <div class="products">

        <div class="content">
            <img src="kukka1.jpg" width="110px" height="90px" alt="Orkidea">
            <div class="kuvaus">Orkidea<br>
                <button value="2" onclick="koriin(this)">2 euroa</button>
            </div>
        </div>

        <div class="content">

            <img src="Kukka2.jpg" width="110px" height="90px" alt="Oranssi ruusu">
            <div class="kuvaus">Oranssi ruusu<br>
                <button value="10" onclick="koriin(this)">10 euroa</button>
            </div>
        </div>

        <div class="content">
            <img src="Kukka3.jpg" width="110px" height="90px" alt="Vaaleanpunainen ruusu">
            <div class="kuvaus">Vaaleanpunainen ruusu<br>
                <button value="12" onclick="koriin(this)">12 euroa</button>
            </div>
        </div>

    </div>
</body>

</html>