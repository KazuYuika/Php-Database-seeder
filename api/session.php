<?php
// Turn off all error reporting
error_reporting(0);

// Do not display errors (they can still be logged to the server's error log file)
ini_set('display_errors', '0');
require_once 'vendor/autoload.php';
require_once 'seeder.php';
session_start();

$host = $_SESSION['host'];
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$selectedDatabase = isset($_GET['databases']) ? $_GET['databases'] : null;
$selectedTable = isset($_GET['table']) ? $_GET['table'] : null;
$db = new mysqli($host, $user, $pass, $selectedDatabase);       

?>