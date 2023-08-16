<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="signup.css"/>
</head>
<body>
<form class="form" method="post" name="login">
    <h1 class="login-title">Login</h1>
    <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
    <input type="password" class="login-input" name="password" placeholder="Password"/>
    <input type="submit" value="Login" name="submit" class="login-button"/>
    <p class="link">Don't have an account? <a href="index.php">Registration Now</a></p>
</form>
<?php
require('db.php');
session_start();
// When form submitted, check and create user session.
if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);    // removes backslashes
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    // Check user is exist in the database
    $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $_SESSION['username'] = $username;
        // Redirect to user dashboard page
        header("Location: dashboard.php");
    } else {
        echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
    }
} else {
    ?>

    <?php
}
?>

</body>
</html>