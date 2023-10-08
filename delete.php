<?php

//connection
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
// $result = $connection->query("DELETE FROM employee WHERE id={$_GET['id']} ");
$db->delete_data("employee", $_GET['id']);

//closing connection
// $connection->close();

//redirection
header("Location:list.php");
