<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Nelikan Kotisivut</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/neilikka.css">
    <link rel="stylesheet" href="css/welcome.css">
</head>
<script>
    $(function() {
        $(".navibar").load("../naviLoggedIn.html");
    });
</script>

<body>

    <div class="navibar"></div>
    <h1>Welcome <?php echo $_SESSION['firstName']; ?></h1>
    <fieldset class = "center">
        <legend>Kryptot</legend>
        <ol id="all">

        </ol>
        <ol>
            <span id="nok"></span>
        </ol>
    </fieldset>

    <script src="cryptos.js" async defer></script>
</body>

</html>