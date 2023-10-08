<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Page</title>
</head>

<body>
    <table border="2">
        <tr>
            <th>f_name</th>
            <th>l_name</th>
            <th>email</th>
            <th>gender</th>
            <th>password</th>
            <th>image</th>
            <th>actions</th>
        </tr>

        <?php

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

        //check if visitor has a cookie or sessionID
        session_start();
        if (!isset($_SESSION['email'])) {
            header("location:login.php?");
        }
        //heading
        echo "<h5>Welcome back, {$_SESSION['f_name']} {$_SESSION['l_name']}</h5>";

        //query
        // $result = $connection->query("SELECT * FROM employee");
        $result = $db->get_all_data("employee");

        while ($row = $result->fetch_assoc()) {
            echo " <tr>";
            foreach ($row as $key => $value) {
                if ($key !== "id") {
                    if ($key == "image") {
                        echo "<td> <img src =  'images/{$value}'  style='width: 40px;'></td>";
                    } else {
                        echo "<td>$value</td>";
                    }
                }
            }

            echo " <td>
        <a href='view.php?id={$row["id"]}'>View</a>
        <a href='edit.php?id={$row["id"]}'>Edit</a>
        <a href='delete.php?id={$row["id"]}'>Delete</a>
         </td>";

            echo " </tr>";
        }
        //closing connection
        // $connection->close();
        ?>
    </table>
    <h5><a href="register.php">Add new user</a></h5>
</body>

</html>