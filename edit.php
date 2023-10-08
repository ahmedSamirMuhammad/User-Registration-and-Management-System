<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Page</title>
</head>

<body>

    <?php
    //fetch id
    $id = $_GET["id"];

    //connect
    // $connection = new mysqli("localhost", "root", "", "database1");
    //[1] importing the database.php file
    require("database.php");
    //[2] creating new object from class "Database"
    $db = new Database();
    $db_connect = $db->get_connection();
    if ($db_connect->connect_error) {
        die("Connection failed: " . $db_connect->connect_error);
    }

    //query
    // $result = $connection->query("SELECT * FROM employee WHERE id=$id");
    $result = $db->get_row_data("employee", $id);
    $data = $result->fetch_assoc();

    //closing connection
    // $connection->close();
    ?>

    <form action='controller.php' method='post' enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>">
        <label for="f_name">First Name </label>
        <input type="text" name='f_name' id='f_name' value="<?= $data['f_name'] ?>">
        <br>
        <label for="l_name">Last Name </label>
        <input type="text" name='l_name' id='l_name' value="<?= $data['l_name'] ?>">
        <br>
        <label for="email">Email</label>
        <input type="email" name='email' id='email' value="<?= $data['email'] ?>">
        <br>
        <label>Gender : </label>

        <input type="radio" name='gender' value='male' id='male' <?php if ($data['gender'] == "male") {
                                                                        echo "checked";
                                                                    } ?>>
        <label for='male'>Male</label>

        <input type="radio" name='gender' value='female' id='female' <?php if ($data['gender'] == "female") {
                                                                            echo "checked";
                                                                        } ?>>
        <label for='female'>Female</label>
        <br>
        <label for="password">password </label>
        <input type="password" id="password" name='password' value="<?= $data['password'] ?>">
        <br>
        <label for="image">Profile Picture </label>
        <input type="file" name="image" id="image">
        <br><br>
        <input type="submit" value="Submit" name="edit">
        <input type="reset" value="Reset" name="reset">
    </form>

</body>

</html>