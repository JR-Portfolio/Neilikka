<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

require 'config.php';

function debug_to_console($data)
{
    echo "<script>console.log('Debug: " . json_encode($data) . "' );</script>";
}



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $new_password_err = $password_err = $username_err = "";
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $newPassword = mysqli_real_escape_string($link, $_POST['new_password']);

    $all = $username . ", " . $password . ", " . $newPassword;
    $generatorFlag = 0;
    //password generator
    if (isset($_POST['generator']))
    {
        $generatorFlag = 1;
        debug_to_console("Generator clicked");

        $str = date('d-mm-yyyy') . "_omnia" . "php-mysql-javascript-html-css-azure-xampp";
        debug_to_console($str);

        $generatedPSW = substr(str_shuffle($str), 0, 5);
        debug_to_console($generatedPSW);

        if (empty($username))
        {
?>
            <script>
                alert("Your new psw: <?php echo $generatedPSW; ?> , set your username..");
            </script><?php
                    }
                    else
                    { ?>
            <script>
                alert("Your new psw: <?php echo $generatedPSW; ?>");
            </script><?php
                    }
                }
                else
                {
                    debug_to_console("Submit clicked");

                    Debug_to_console($all);

                    if (!empty($username) && !empty($password) && !empty($newPassword))
                    {
                        debug_to_console("Fields updated");
                        $secretPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                        $sql = "UPDATE users set password = '$secretPassword'  WHERE username = '$username'";
                        debug_to_console($sql);
                        $result = mysqli_query($link, $sql) || die('Updating password failed') . mysqli_error($link);
                        if ($result)
                        {
                            debug_to_console("Opening login.php");
                            header("location: login.php");
                        ?>
                <script>
                    setTimeout(() => {
                        alert("Password changed");
                        window.location.href = "login.php";
                    }, 2500);
                </script><?php
                        }
                    }
                }
            }
                            ?>
<!--<script>
    alert("Password changed");
    setTimeout(() => {
        window.location.href = "login.php";
    }, 2500);
</script>-->

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Change password</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/control.css">
</head>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Change password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs_validation" novalidate>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="username" name="username" class="form-control" value="<?php echo (isset($username)) ? $username : ''; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        <span class="valid-feedback">Looks ok ?></span>
                    </div>


                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo (isset($generatedPSW)) ? $generatedPSW : ''; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        <span class="valid-feedback">Looks ok</span>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control" value="<?php echo (isset($generatedPSW)) ? $generatedPSW : ''; ?>">
                        <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                        <span class="valid-feedback">Looks ok</span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Change password">
                        <input type="submit" name="generator" class="btn btn-primary" value="Generate Password">
                    </div>
                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </form>
            </div>
        </div>
    </div>
</body>


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</html>