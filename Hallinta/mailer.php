<?php
session_start();

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.phhp';

define ('SMTPUSERNAME', $_SESSION['username']);


function sendPost($emailTo, $msg, $subject){


}

?>