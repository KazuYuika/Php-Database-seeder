<?php
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