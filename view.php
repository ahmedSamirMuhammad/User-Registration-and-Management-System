<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Page</title>
</head>

<body>
    <?php

    $id = $_GET["id"];

    // [1] Importing the database.php file
    require("database.php");

    // [2] Creating a new object from the class "Database"
    $db = new Database();
    $db_connect = $db->get_connection();

    if ($db_connect->connect_error) {
        die("Connection failed: " . $db_connect->connect_error);
    }

    //query

    // $result = $connection->query("SELECT * FROM employee where id=$id");
    $result = $db->get_row_data("employee", $id);

    echo "<ul>";
    while ($data = $result->fetch_assoc()) {
        foreach ($data as $value) {
            echo "<li>$value</li>";
        }
    }

    echo "</ul>";


    ?>
</body>

</html>