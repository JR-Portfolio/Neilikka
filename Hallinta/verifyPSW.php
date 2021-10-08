<!DOCTYPE html>
<html>

<head>
    <title>Reset Password - verify email</title>
    <link rel="stylesheet" href="css/control.css">
    <?php
    require 'config.php';
    require '../inc/header.php';
    ?>
</head>

<?php
function debug_to_console($data)
{
    echo "<script>console.log('Debug: " . json_encode($data) . "' );</script>";
}

(session_status() === PHP_SESSION_NONE) ? session_start() : debug_to_console("session already started");

$email = $email_err = "";
$errors = [];

//get and purity email
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    debug_to_console("submit clicked");
    $email = mysqli_real_escape_string($link, $_POST['email']);

    //check if email exist
    debug_to_console("email validated, checking if email already registered");
    $checkEmail = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $checkEmail) or die("checking email failed");
    mysqli_error($link);

    if (mysqli_num_rows($result) != 0)
    {
        debug_to_console("Email found");

        //generate a unique random token of length 100
        $token = bin2hex(random_bytes(50));
        $_SESSION['token'] =  $token;

        //udpate token to users table and not to new table.
        $updToken = "UPDATE users set token = '$token' WHERE email = '$email'";
        $result = mysqli_query($link, $updToken) or die('Updating token failed ' . $updToken);
        mysqli_error($link);

        // Send email to user with the token in a link they can click on
        require 'mailerConfig.php';
        //$msg = "Hi there, click on this <a href=\"new_password.php?token=" . $token . "\">link</a> to reset your password on our site";

        $pos = strpos($email, "@");
        $user = substr($email, 0, $pos);

        $msg = "<h3>Hi " . $user . "</h3><p><span>Reset your password via <a href=" .URL. "/newPassword.php?token=" . $token . ">here</a>
        <p><strong>Note</strong> reset link expires in 5 minutes.<p>Best Regards,<br>Nelikka Admin Robot</span>";
        $msg = wordwrap($msg, 70);

        $mail->setFrom('noreply@neilikka.com', 'Dear receipant');

        $mail->addAddress($email, 'Dear recipient');
        $mail->MsgHTML($msg);

        if (!$mail->Send())
        {
            debug_to_console("mail sending failed");
            var_dump($mail);
        }
        else
        {
            $startTime  = date('H:i');
            $_SESSION['startTime'] = $startTime;
            debug_to_console("mail sent");
            // Redirect to login page
            //$pos = strpos($email, "@");
            //$domain = substr($email, $pos + 1);
            header("location: pending.php");
        }
    }
    else
    {
        debug_to_console("Email not found");
        $email_err = "Email not found, exit";
        array_push($errors, $email_err);
    }
}
?>


<body>

    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <h2>Reset Password</h2>
                <p>Fill your password</p>
                <form method = "post">
                    <div class="form-group row my-5">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" name = "email" id="staticEmail" value="jriimala@gmail.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Verify">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>