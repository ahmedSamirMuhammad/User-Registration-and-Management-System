<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>

<body>
    <?php
    if (isset($_GET['errors'])) {
        //fetching the errors
        $errors = $_GET['errors'];
        //convert the errors from "json format" into "array"
        $errors = json_decode($errors, true);
    }
    ?>


    <form action='controller.php' method='post' enctype="multipart/form-data">

        <label for="f_name">First Name </label>
        <input type="text" name='f_name' id='f_name'>
        <?php
        if (isset($errors['f_name'])) {
            echo "<span style='color:red;'>{$errors['f_name']}</span>";
        }
        ?>
        <br>
        <label for="l_name">Last Name </label>
        <input type="text" name='l_name' id='l_name'>
        <?php
        if (isset($errors['l_name'])) {
            echo "<span style='color:red;'>{$errors['l_name']}</span>";
        }
        ?>
        <br>
        <label for="email">Email</label>
        <input type="email" name='email' id='email'>
        <?php
        if (isset($errors['email'])) {
            echo "<span style='color:red;'>{$errors['email']}</span>";
        }
        ?>
        <br>
        <label>Gender : </label>

        <input type="radio" name='gender' value='male' id='male'>
        <label for='male'>Male</label>

        <input type="radio" name='gender' value='female' id='female'>
        <label for='female'>Female</label>
        <?php
        if (isset($errors['gender'])) {
            echo "<span style='color:red;'>{$errors['gender']}</span>";
        }
        ?>
        <br>
        <label for="password">password </label>
        <input type="password" id="password" name='password'>
        <?php
        if (isset($errors['password'])) {
            echo "<span style='color:red;'>{$errors['password']}</span>";
        }
        ?>
        <br>
        <label for="image">Profile Picture </label>
        <input type="file" name="image" id="image">
        <br><br>
        <input type="submit" value="Submit" name="add">
        <input type="reset" value="Reset" name="reset">
    </form>
</body>

</html>