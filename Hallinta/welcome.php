<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/welcome.css">
    </head>
    <body>

        <h1>Welcome <?php echo $_SESSION['firstName']; ?></h1>
        <fieldset>
            <legend>Kryptot</legend>
            <ol id = "all">

            </ol>
            <ol>
                <span id = "nok"></span>
            </ol>
        </fieldset>

        <script src="cryptos.js" async defer></script>
    </body>
</html>