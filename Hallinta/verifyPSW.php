<!DOCTYPE html>
<html>

<?php
function debug_to_console($data)
{
    echo "<script>console.log('Debug: " . json_encode($data) . "' );</script>";
}

(session_status() === PHP_SESSION_NONE) ? session_start() : debug_to_console("session already started");

require 'config.php';
require '../inc/header.php';
$email = $email_err = "";
$errors = [];

//get and purity email
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    debug_to_console("submit clicked");
    $email = mysqli_real_escape_string($link, $_POST['email']);
    debug_to_console($email);

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
        $result = mysqli_query($link, $updToken) or die ('Updating token failed '. $updToken); mysqli_error($link);

        // Send email to user with the token in a link they can click on
        require 'mailerConfig.php';
        $msg = "Hi there, click on this <a href=\"http://localhost/Neilikka/Hallinta/newPassword.php?token=" . $token . "\">link</a> to reset your password on our site";
        $msg = wordwrap($msg, 70);

        $mail->setFrom('noreply@neilikka.com', 'Dear receipant');
        $mail->addAddress($email, 'Dear receipant');
        $mail->MsgHTML($msg);
        if (!$mail->Send())
        {
            debug_to_console("mail sending failed");
            var_dump($mail);
        }
        else
        {
            debug_to_console("mail sent");
            // Redirect to login page
            $pos = strpos($email, "@");
            $domain = substr($email, $pos + 1);
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
    <div class="container mt-5">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
            <h1 class="display-6 py-2 text-truncate">Password Reset Form</h1>
            <div class="px-2">
                <form method="post" class="justify-content-center">
                    <div class="form-group row">
                        <label class="sr-only" for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="username@domain.org" value="jriimala@gmail.com">
                    </div>

                    <div class="form-group mt-5">
                        <input type="submit" name="submit" class="btn btn-primary" value="Verify">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src=" " async defer></script>
</body>

</html>