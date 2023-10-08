<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controller Page</title>
</head>

<body>
    <?php

    //fetch id
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
    }
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

    $array = [];
    if (!isset($_POST['login'])) {
        //validation
        $f_name = validate($_POST['f_name']);
        $f_name = ucwords(strtolower($f_name));
        $l_name = validate($_POST['l_name']);
        $l_name = ucwords(strtolower($l_name));
        $email = validate($_POST['email']);
        $gender = validate($_POST['gender']);
        $password = validate($_POST['password']);

        //adding the error statement for each input inside an array

        if (strlen($f_name) < 2) {
            $array['f_name'] = "first name must be more than 2 characters";
        }
        if (strlen($l_name) < 2) {
            $array['l_name'] = "last name must be more than 2 characters";
        }
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $array['email'] = "email format is invalid";
        }
        if (empty($gender)) {
            $array['gender'] = "please select a gender";
        }
        if (strlen($password) < 6) {
            $array['password'] = "password must be more than 6 characters";
        }
    }
    //if array contains errors >> redirect to register page
    if (count($array) > 0 && !isset($_POST['login'])) {

        //convert array content into json format to receive it in register page
        $errors = json_encode($array);
        //redirect and inject the errors in "query string"
        header("location:register.php?errors=$errors");
    } else {

        // (1) if submit button name = add
        if (isset($_POST['add'])) {
            // move image from temp_path to project folder
            $image = $_FILES['image'];
            move_uploaded_file($image['tmp_name'], "images/" . $image['name']);

            // execute a query
            // $query = $connection->prepare("INSERT INTO employee (f_name, l_name, email, gender, password, image) VALUES (?,?,?,?,?,?)");
            // $query->bind_param("ssssss", $f_name, $l_name, $email, $gender, $password, $image['name']);
            // $query->execute();
            $db->insert_data("employee", $f_name, $l_name, $email, $gender, $password, $image);

            // redirect to list
            header("location:list.php");

            // (2) if submit button name = edit
        } else if (isset($_POST['edit'])) {
            // move image from temp_path to project folder
            $image = $_FILES['image'];
            move_uploaded_file($image['tmp_name'], "images/" . $image['name']);

            // execute a query
            // $query = $connection->prepare("UPDATE employee SET f_name=?, l_name=?, email=?, gender=?, password=?, image=? WHERE id=$id");
            // $query->bind_param("ssssss", $f_name, $l_name, $email, $gender, $password, $_FILES['image']['name']);
            // $query->execute();
            $db->update_data("employee", $f_name, $l_name, $email, $gender, $password, $image, $id);

            // redirect to list
            header("location:list.php");

            // (3) if submit button name = login
        } else if (isset($_POST['login'])) {

            //fetch the login data from the post array
            $email = $_POST['email'];
            $password = $_POST['password'];

            //check if the given "email" & "password" are existing in our grid "database" table
            // $query = $connection->prepare("SELECT * FROM employee WHERE email=? AND password=?");
            // $query->bind_param("ss", $email, $password);
            // $query->execute();

            //get the row data in "$row" from database
            // $result = $query->get_result();
            // $row = mysqli_fetch_assoc($result);
            $row = $db->get_row_data("employee", $email, $password);

            //check if row exits in our grid "database"
            if ($row) {
                // Start the session
                session_start();

                // Assign values to session variables from the fetched row
                $_SESSION['f_name'] = $row['f_name'];
                $_SESSION['l_name'] = $row['l_name'];
                $_SESSION['email'] = $row['email'];

                // Redirect to the list page
                header("location:list.php");
            } else {
                // Redirect to the login page with an error message
                header("location:login.php?error_auth=notValid");
            }
        }
    }


    //validate function
    function validate($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //closing connection
    // $connection->close();

    ?>
</body>

</html>