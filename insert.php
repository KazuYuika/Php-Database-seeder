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
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'type_') === 0) { // Check if the POST key starts with 'type_'
            $fieldName = substr($key, 5); // Extract the field name
            $fields[$fieldName] = $value; // Use the selected type from the form
        }
    }

    // Populate the table with the specified number of entries
    $seeder->seed($selectedTable, $fields, $numberOfEntries);

    $db->close();
    header('Location: home.php');

}

?>