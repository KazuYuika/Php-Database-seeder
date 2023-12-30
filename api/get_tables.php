<?php
// get_tables.php
session_start();

// Check if the database name is provided and the session variables are set
if (isset($_GET['database'])) {
    $database = $_GET['database'];
    $user = 'root';
    $pass = '';
    $host = 'localhost';
    $db = new mysqli($host, $user, $pass, $database);

    // Check for database connection error
    if ($database) {
        $sql = "SHOW TABLES";
        $response = $db->query($sql);
        $tables = [];
        while ($row = $response->fetch_row()) {
            $tables[] = $row[0];
        }
        echo json_encode($tables);
    } else {
        echo json_encode([]);
    }

    // Close the database connection
    $db->close();
}
?>