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

<?php require '../inc/header.php'; ?>

<head>
    <title>Nelikan Kotisivut</title>
    <link rel="stylesheet" href="../css/neilikka.css">
    <link rel="stylesheet" href="css/welcome.css">
</head>

<script>
    $(function() {
        $(".navibar").load("../naviLoggedIn.html");
    });
</script>

<body>

    <?php
    function debug_to_console($data)
    {
        echo "<script>console.log('Debug: " . json_encode($data) . "' );</script>";
    }

    if (!$_COOKIE['username'] && !$_COOKIE['password'])
    {
        debug_to_console('remember cookie not set');
    }
    else
    {
        $username = $_COOKIE['username'];
    }


    ?>


    <div class="navibar"></div>
    <h1>Welcome <?php echo $_SESSION['firstName']; ?></h1>
    <fieldset class="center">
        <legend><?php echo $username . ' ';?> Kryptot</legend>
        <ol id="all">

        </ol>
        <ol>
            <span id="nok"></span>
        </ol>
    </fieldset>

    <script src="cryptos.js" async defer></script>
</body>

</html>