<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>PHP Login System</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/control.css">
</head>

<body>

    <?php
    // Initialize the session
    session_start();

    function debug_to_console($data)
    {
        echo "<script>console.log('Debug: " . json_encode($data) . "' );</script>";
    }


    // Check if the user is already logged in, if yes then redirect him to welcome page
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        header("location: welcome.php");
        exit;
    }

    // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $firstName = $lastName = $username = $password = "";
    $firstName_err = $lastName_err = $username_err = $password_err = $login_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Check if username is empty
        if (empty(trim($_POST["username"])))
        {
            $username_err = "Please enter username.";
        }
        else
        {
            $username = trim($_POST["username"]);
            $_SESSION['username'] = $username;
            echo $_SESSION['username'];
        }

        // Check if password is empty
        if (empty(trim($_POST["password"])))
        {
            $password_err = "Please enter your password.";
        }
        else
        {
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if (empty($username_err) && empty($password_err))
        {
            // Prepare a select statement
            $sql = "SELECT id, firstName, username, password FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql))
            {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = $username;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt))
                {
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if username exists, if yes then verify password
                    if (mysqli_stmt_num_rows($stmt) == 1)
                    {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $firstName, $username, $hashed_password);
                        if (mysqli_stmt_fetch($stmt))
                        {
                            if (password_verify($password, $hashed_password))
                            {
                                // Password is correct, so start a new session
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["firstName"] = $firstName;
                                echo $_SESSION["firstName"];
                                $_SESSION["username"] = $username;

                                $cookie1 = "username";

                                if (isset($_POST['cb']))
                                {
                                    debug_to_console('cb-checked');
                                    setcookie('remember', 'checked', time() + (86400 * 30));
                                    setcookie('username', $username, time() + (86400 * 30));
                                    setcookie('password', $password, time() + (86400 * 30));
                                }


                                echo "remember cookie has a value " . $_COOKIE['remember'];
                                echo "Username cookie has a value " . $_COOKIE['username'];
                                echo "Password cookie has a value " . $_COOKIE['password'];

                                // Redirect user to welcome page
                                header("location: welcome.php");
                            }
                            else
                            {
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password.";
                            }
                        }
                    }
                    else
                    {
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid username or password.";
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

        // Close connection
        mysqli_close($link);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </style>
    </head>

    <body>
        <div class="App">
            <div class="vertical-center">
                <div class="inner-block">

                    <h2>Login</h2>
                    <p>Please fill in your credentials to login.</p>

                    <?php
                    if (!empty($login_err))
                    {
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }
                    ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> value="<?php isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            <span class="valid-feedback">Looks good</span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            <span class="valid-feedback">Looks good</span>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="cb" id="invalidCheck">
                                <label class="form-check-label" for="invalidCheck">Remember</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Login">
                            <p></p>
                            <a href="verifyPSW.php">Forgot password?</a>
                        </div>
                        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                    </form>
                </div>
            </div>
        </div>

    </body>
    <script src="validoi.js" async defer></script>

    </html>