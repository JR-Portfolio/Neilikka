<?php
if (count($errors) > 0)
{
    date_default_timezone_set("Europe/Helsinki");
    $time  = date('d-m-y H:i:s');
    file_put_contents("errors.log", "Errors in " . __FILE__ . '<br>');
    foreach ($errors as $error)
    {
        echo "error: " . $error;
        file_put_contents("../logs/errors.log",  $time .' line nro: '.  __LINE__ . ' err: ' . $error . PHP_EOL, FILE_APPEND);
    }
}
?>
