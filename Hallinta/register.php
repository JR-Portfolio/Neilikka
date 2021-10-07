<?php
session_start();
require 'mailerConfig.php';

// Include config file
require_once "config.php";
$errors = [];

function debug_to_console($data)
{
    echo "<script>console.log('Debug: " . json_encode($data) . "' );</script>";
}

// Define variables and initialize with empty values
$firstName = $lastName = $email = $userName = $password = $confirm_password = "";
$firstName_err = $lastName_err = $email_err =  $username_err = $password_err = $confirm_password_err = $mailSending_err = "";

//$mail = new PHPMailer\PHPMailer\PHPMailer();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    debug_to_console("Form posted");
    $firstName = mysqli_real_escape_string($link, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($link, $_POST['lastName']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $userName = mysqli_real_escape_string($link, $_POST['userName']);
    $password = mysqli_real_escape_string($link, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($link, $_POST["confirm_password"]);

    //Validate first name
    if (empty($firstName))
    {
        $firstName_err = "Please enter a first name";
        array_push($errors, $firstName_err);
    }
    else if (!preg_match('/^[a-zA-Z ]*$/', $firstName))
    {
        $firstName_err = "First name can include only letters.";
        array_push($errors, $firstName_err);
        debug_to_console($firstName_err);
    }
    else
    {
        debug_to_console("firstName validated");
        $_SESSION['fisrtName'] = $firstName;
    }

    //Validate last name
    if (empty($lastName))
    {
        $lastName_err = "Please enter a last name";
        array_push($errors, $lastName_err);
    }
    else if (!preg_match('/^[a-zA-Z ]*$/', $lastName))
    {
        $lastName_err = "Last name can include only letters.";
        array_push($errors, $lastName_err);
        debug_to_console($lastName_err);
    }
    else
    {
        debug_to_console("Lastname validated");
        $_SESSION['lastName'] = $lastName;
    }

    //validate email
    if (empty($email))
    {
        debug_to_console("empty email field");
        $email_err = "empty field";
        array_push($errors, $email_err);
    }

    else if (!empty($email) && (filter_var($email, FILTER_VALIDATE_EMAIL) === false))
    {
        $email_err = "Please enter a valid email.";
        array_push($errors, $email_err);
        debug_to_console($email_err);
    }
    else
    {
        debug_to_console("email validated, checking if email already registered");
        $checkEmail = "SELECT id FROM users WHERE email = '$email'";
        $result = mysqli_query($link, $checkEmail) or die("checking email failed");
        mysqli_error($link);

        if (mysqli_num_rows($result) != 0)
        {
            $email_err = "Email already registered";
            array_push($errors, $email_err);
            debug_to_console($email_err);
        }
        else
        {
            $email_err = "";
            debug_to_console("Entered email not found, ok to proceed");
        }
    }

    // Validate username
    if ((strlen($userName) < 4) || (strlen($userName) > 10 ) )
    {
        $username_err = "Username length need to be between 5-10 chars.";
        array_push($errors, $username_err);
        debug_to_console($username_err);
    }
    elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $userName))
    {
        $username_err = "Username can only contain letters, numbers, and underscores.";
        array_push($errors, $username_err);
        debug_to_console($username_err);
    }
    else
    {
        debug_to_console("Username validated, checking dublicate ones");
        $sql = "SELECT id FROM users WHERE username = '$userName'";
        $checkUsername = mysqli_query($link, $sql) or die("Checking username failed");
        mysqli_error($link);
        if (mysqli_num_rows($checkUsername) != 0)
        {
            $username_err = "This username is already taken.";
            array_push($errors, $username_err);
            debug_to_console($username_err);
        }
        else
        {
            debug_to_console("Username not registered, ok to proceed");
        }
    }

    // Validate password
    if (empty($password))
    {
        $password_err = "Please enter a password.";
        array_push($errors, $password_err);
    }
    elseif (strlen($password) < 6)
    {
        $password_err = "Password must have atleast 6 characters.";
        array_push($errors, $password_err);
        debug_to_console($password_err);
    }
    else
    {
        debug_to_console("password validated");
    }

    // Validate confirm password
    if (empty($confirm_password))
    {
        $confirm_password_err = "Please confirm password.";
        array_push($errors, $confirm_password_err);
    }
    else
    {
        if (empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match or password was empty.";
            array_push($errors, $confirm_password_err);
            debug_to_console($password_err);
        }
    }

    if (empty($firstName_err) && (empty($lastName_err) && (empty($email_err) &&
        (empty($username_err) && empty($password_err) && empty($confirm_password_err)))))
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $token = $_SESSION['token'];

        // Prepare an insert statement
        $sql = "INSERT INTO users (firstName, lastName, email, username, password, token) VALUES ('$firstName', '$lastName', '$email', '$userName', '$password', '$token')";
        debug_to_console($sql);

        $execute = mysqli_query($link, $sql) or die('sql insert into failed, ' . mysqli_error($link));
        // Attempt to execute the prepared statement
        debug_to_console("Insert into executed " .$token);

        //send mail verification

        $content = 'Click on the activation link to verify your email. <br><br>
                <a href="http://localhost/Neilikka/Hallinta/user_verificatIon.php?token='.$token.'">Click here to verify email</a>';

        $mail->MsgHTML($content);
        if (!$mail->Send())
        {
            debug_to_console("mail sending failed");
            $mailSending_err = "main sending failed";
            array_push($errors, $mailSending_err);
            var_dump($mail);
        }
        else
        {
            debug_to_console("mail sent");
            // Redirect to login page
            $pos = strpos($email, "@");
            $domain = substr($email, $pos + 1);
            header("location: thx.php");
        }
    }
    else
    {
        debug_to_console("Some error fields are not empty");
    }

    require 'errors.php';
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>New user registration</title>
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="css/control.css">
</head>

<?php
require "../inc/header.php";
?>

<body>
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <h2>Sign Up</h2>
                <p>Please fill this form to create an account.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs_validation" novalidate>

                    <div class="form-group">
                        <label>Firstname</label>
                        <input type="text" name="firstName" class="form-control" <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>">
                        <span class="invalid-feedback"><?php echo $firstName_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Lastname</label>
                        <input type="text" name="lastName" class="form-control <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>">
                        <span class="invalid-feedback"><?php echo $lastName_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>

                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="userName" class="form-control" value="<?php echo $userName; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                    </div>
                    <span>Already have an account? <a href="login.php">Login here</a>.</span>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="validoi.js"></script>

</html>