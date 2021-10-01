<html>
<HEAD>
  <!--LINK href="master.css" rel="stylesheet" type="text/css"-->
</HEAD>
<body>

<?php

$un = "root";
$ps = "";
$server = "localhost";
$database = "jrla";
$table = "moto";

//show all erros if any
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Create connection to DB
$link = new mysqli($server, $un, $ps, $database);
// Check connection
if ($link->connect_error) {
    print "connection error";
    die("Connection failed: " . $link->connect_error);
} 

//print "connected";


?>

</body>
</html>
