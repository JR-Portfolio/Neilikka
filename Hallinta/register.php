<?php
session_start();
require 'mailerConfig.php';

function debug_to_console($data)
{
    echo "<script>console.log('Debug: " . json_encode($data) . "' );</script>";
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$firstName = $lastName = $email = $username = $password = $confirm_password = "";
$firstName_err = $lastName_err = $email_err =  $username_err = $password_err = $confirm_password_err = "";

//$mail = new PHPMailer\PHPMailer\PHPMailer();


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    debug_to_console("Form posted");
    $firstName = mysqli_real_escape_string($link, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($link, $_POST['lastName']);

    //Validate first name
    if (empty($firstName))
    {
        $firstName_err = "Please enter a first name";
    }
    else if (!preg_match('/^[a-zA-Z ]*$/', $firstName))
    {

        $firstName_err = "First name can include only letters.";
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
    }
    else if (!preg_match('/^[a-zA-Z ]*$/', trim($_POST['lastName'])))
    {
        $lastName_err = "Last name can include only letters.";
        debug_to_console($lastName_err);
    }
    else
    {
        debug_to_console("Lastname validated");
        $_SESSION['lastName'] = $lastName;
    }

    if (!empty($email) and (filter_var($email, FILTER_VALIDATE_EMAIL) === false))
    {
        $email_err = "Please enter a valid email.";
        debug_to_console($email_err);
    }
    else
    {

        debug_to_console("email validated");

        // Validate username
        if (empty(trim($_POST["username"])))
        {
            $username_err = "Please enter a username.";
        }
        elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
        {
            $username_err = "Username can only contain letters, numbers, and underscores.";
            debug_to_console($username_err);
        }
        else
        {
            debug_to_console("username validated");
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql))
            {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = trim($_POST["username"]);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt))
                {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1)
                    {
                        $username_err = "This username is already taken.";
                        debug_to_console($username_err);
                    }
                    else
                    {
                        $username = trim($_POST["username"]);
                    }
                }
                else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate password
        if (empty(trim($_POST["password"])))
        {
            $password_err = "Please enter a password.";
        }
        elseif (strlen(trim($_POST["password"])) < 6)
        {
            $password_err = "Password must have atleast 6 characters.";
            debug_to_console($password_err);
        }
        else
        {
            $password = trim($_POST["password"]);
            debug_to_console("password validated");
        }

        // Validate confirm password
        if (empty(trim($_POST["confirm_password"])))
        {
            $confirm_password_err = "Please confirm password.";
        }
        else
        {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password))
            {
                $confirm_password_err = "Password did not match.";
                debug_to_console($password_err);
            }
        }

        // Check input errors before inserting in database
        if (empty($username_err) && empty($password_err) && empty($confirm_password_err))
        {
            debug_to_console($username_err);
            debug_to_console($password_err);
            debug_to_console($confirm_password_err);
            $password = password_hash($password, PASSWORD_BCRYPT);
            $token = $_SESSION['token'];

            // Prepare an insert statement
            $sql = "INSERT INTO users (firstName, lastName, email, username, password, token) VALUES ('$firstName', '$lastName', '$email', '$username', '$password', '$token')";
            debug_to_console($sql);

            $execute = mysqli_query($link, $sql) or die('sql insert into failed, ' . mysqli_error($link));
            // Attempt to execute the prepared statement
            debug_to_console("Insert into executed");

            debug_to_console($token);
            //send mail verification
            $msg = 'Click on the activation link to verify your email. <br><br>
                  <a href="http://localhost/php-user-authentication/user_verification.php?token=' . $token . '"> Click here to verify email</a>
                ';


            $mail->MsgHTML($content);
            if (!$mail->Send())
            {
                echo "Error while sending Email.";
                debug_to_console("mail sending failed");
                var_dump($mail);
            }
            else
            {
                debug_to_console("mail sent");
                echo "Email sent successfully";
                // Redirect to login page
                header("location: login.php");
            }
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
            debug_to_console("stmt executed");
        }

        // Close connection
        mysqli_close($link);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="./css/style.css">-->
    <title>PHP User Registration System Example</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/control.css">
</head>

<body>
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <h2>Sign Up</h2>
                <p>Please fill this form to create an account.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="form-group">
                        <label>Firstname</label>
                        <input type="text" name="firstName" class="form-control <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>">
                        <span class="invalid-feedback"><?php echo $firstName_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Lastname</label>
                        <input type="text" name="lastName" class="form-control <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>">
                        <span class="invalid-feedback"><?php echo $lastName_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                    </div>
                    <p>Already have an account? <a href="login.php">Login here</a>.</p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>