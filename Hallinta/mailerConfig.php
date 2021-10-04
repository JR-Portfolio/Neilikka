<?php
@session_start();
//phpinfo();

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
//require 'mailerConfig.php';
//

$mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet="UTF-8";
    $mail->SMTPSecure = 'tls';
    $mail->SMTPSecure = "tsl";
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPDebug  = 0;
    $mail->Username   = "jriimala@gmail.com";
    $mail->Password   = "JRLA-maigeri";
    $mailPSW = password_hash($mail->Password, PASSWORD_BCRYPT);
    $mail->SMTPAuth   = TRUE;
    // Generate random activation token
    $token = md5(rand().time());
    $_SESSION['token'] = $token;
    $mail->IsHTML(true);
    $mail->SetFrom($mail->Username, "From");
    $mail->AddAddress("jriimala@gmail.com", "Jouni R.");

//$mail->AddReplyTo("reply-to-email@domain", "reply-to-name");
//$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
  $mail->Subject = "Email verification";
  $content = 'Click on the activation link to verify your email. <br><br>
<a href="http://localhost/Neilikka/Hallinta/user_verificatIon.php?token='.$token.'">Click here to verify email</a>';


