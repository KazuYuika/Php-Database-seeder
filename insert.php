<?php 


require_once 'vendor/autoload.php';
require_once 'seeder.php';

session_start();

if (isset($_POST['submit'])) {
    $selectedDatabase = $_POST['selectedDatabase'];
    $selectedTable = $_POST['selectedTable'];
    $numberOfEntries = $_POST['numberOfEntries'];

    $host = $_SESSION['host'];
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];

    $db = new mysqli($host, $user, $pass, $selectedDatabase);

    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }

    $seeder = new DatabaseSeeder($db);

    $fields = [];

    // Get the list of fields for the selected table
    $result = $db->query("DESCRIBE $selectedTable");

    while ($row = $result->fetch_assoc()) {
        $fields[$row['Field']] = $row['Type'];
    }

    // Populate the table with the specified number of entries
    $seeder->seed($selectedTable, $fields, $numberOfEntries);

    $db->close();


}

?>