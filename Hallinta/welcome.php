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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP Login System</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/welcome.css">
</head>
<script>
    $(function() {
        $(".navibar").load("../navi.html");
    });
</script>

<body>

    <h1>Welcome <?php echo $_SESSION['firstName']; ?></h1>
    <fieldset>
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