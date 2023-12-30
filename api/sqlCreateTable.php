<?php 
session_start();
if (isset($_POST['submit'])) {
    // Connect to the database
    $host = $_SESSION['host'];
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    $db = new mysqli($host, $user, $pass, $_POST['selectedDatabase']);

        // Retrieve form data
        $tableName = $_POST['floating_text'];
        $columns = [];

        // Assuming you have a way to count the number of columns added
        $numColumns = count($_POST['floating_first_name']); // Replace with actual count

        for ($i = 0; $i < $numColumns; $i++) {
            $name = $_POST['floating_first_name'][$i];
            $dataType = $_POST['floating_data_type'][$i];
            $size = $_POST['floating_size'][$i];
            $index = $_POST['floating_Index'][$i];
            $autoIncrement = isset($_POST['auto_increment'][$i]) ? "AUTO_INCREMENT" : "";

            // Construct column definition
            $columnDef = "`$name` $dataType" . (!empty($size) ? "($size)" : "") . " $autoIncrement";
            if ($index === 'PRIMARY') {
                $columnDef .= " PRIMARY KEY";
            }
            $columns[] = $columnDef;
        }

        // Construct SQL query to create table
        $sql = "CREATE TABLE `$tableName` (" . implode(', ', $columns) . ")";
     
        // Execute query
        if ($db->query($sql) === TRUE) {
           $_SESSION['status'] = 'Success';
           header('Location: createTable.php?databases='. $_POST['selectedDatabase']);
        } else {
            echo "Error creating table: " . $db->error;
        }
    
    }
    
    ?>