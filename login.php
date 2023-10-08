<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body style="text-align: center;">
    <?php

    if (isset($_GET['error_auth'])) {
        echo "Invalid E-mail or Password !";
    }

    ?>
    <h1>Login Form</h1>
    <form action="controller.php" method="post">
        <input type="text" name="email" placeholder="Enter your email"><br>
        <input type="text" name="password" placeholder="Enter your password"><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>