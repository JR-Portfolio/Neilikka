<html>

<HEAD>
  <!--LINK href="master.css" rel="stylesheet" type="text/css"-->
</HEAD>

<body>

  <?php


//Azure url 'https://jounir.azurewebsites.net
//xampp url http://localhost/Neilikka
define('URL', 'http://localhost/Neilikka');


define('LOCAL_SERVER', 'localhost');
define('LOCAL_DATABASE','jrla');
define('LOCAL_USERNAME', 'root');
define('LOCAL_PASSWORD', '');

define('AZURE_SERVER', 'localhost:52365');
define('AZURE_USERNAME', 'azure');
define('AZURE_PASSWORD', '6#vWHD_$');
define('AZURE_DATABASE','neilikka');

$un = LOCAL_USERNAME;
$ps = LOCAL_PASSWORD;
$server = LOCAL_SERVER;
$database = LOCAL_DATABASE;

//show all erros if any
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  // Create connection to DB
  $link = new mysqli($server, $un, $ps, $database);
  // Check connection
  if ($link->connect_error)
  {
    print "connection error";
    die("Connection failed: " . $link->connect_error);
  }

  //print "connected";

  ?>

</body>

</html>
