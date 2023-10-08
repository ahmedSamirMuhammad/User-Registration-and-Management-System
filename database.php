<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>

<body>
    <?php

    class Database
    {
        //define "private" properties
        private $host = "localhost";
        private $user_name = "root";
        private $password = "";
        private $db_name = "database1";
        private $db_connection;

        //creating the constructor function
        function __construct()
        {
            $this->db_connection = new mysqli($this->host, $this->user_name, $this->password, $this->db_name);
        }
        function get_connection()
        {
            return $this->db_connection;
        }
        function get_all_data($_table_name)
        {
            return $this->db_connection->query("SELECT * FROM $_table_name");
        }
        function get_row_data($_table_name, $_condition1, $_condition2 = null)
        {
            if ($_condition2 == null) {
                $query = $this->db_connection->prepare("SELECT * FROM $_table_name WHERE id=?");
                $query->bind_param("s", $_condition1);
                $query->execute();
                $result = $query->get_result();
                return $result;
            } else {
                $query = $this->db_connection->prepare("SELECT * FROM $_table_name WHERE email=? AND password=?");
                $query->bind_param("ss", $_condition1, $_condition2);
                $query->execute();
                $result = $query->get_result();
                $row = mysqli_fetch_assoc($result);
                return $row;
            }
        }

        function insert_data($_table_name, $_f_name, $_l_name, $_email, $_gender, $_password, $_image)
        {
            $query = $this->db_connection->prepare("INSERT INTO $_table_name (f_name, l_name, email, gender, password, image) VALUES (?,?,?,?,?,?)");
            $query->bind_param("ssssss", $_f_name, $_l_name, $_email, $_gender, $_password, $_image['name']);
            $query->execute();
        }
        function update_data($_table_name, $_f_name, $_l_name, $_email, $_gender, $_password, $_image, $_condition)
        {
            $query = $this->db_connection->prepare("UPDATE $_table_name SET f_name=?, l_name=?, email=?, gender=?, password=?, image=? WHERE id=$_condition");
            $query->bind_param("ssssss", $_f_name, $_l_name, $_email, $_gender, $_password, $_image['name']);
            $query->execute();
        }
        function delete_data($_table_name, $_condition)
        {
            $this->db_connection->query("DELETE FROM $_table_name WHERE id=$_condition");
        }
        function __destruct()
        {
            $this->db_connection->close();
        }
    }

    ?>
</body>

</html>