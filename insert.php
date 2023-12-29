<?php 

require_once 'vendor/autoload.php';
session_start();
if (isset($_POST['submit'])){
    $database = $_POST['selectedDatabase'];
    $table = $_POST['selectedTable'];
    $user = 'root';
    $pass = '';
    $host = 'localhost';
    $db = new mysqli($host, $user, $pass, $database);

    
    $db->close();
}



?>