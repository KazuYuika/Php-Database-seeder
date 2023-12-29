<?php
require_once 'vendor/autoload.php';
require_once 'seeder.php';
session_start();

$host = $_SESSION['host'];
$user = $_SESSION['user'];
$pass = '';
$pass = $_SESSION['pass'];

$db = new mysqli($host, $user, $pass);
$selectedDatabase = isset($_GET['databases']) ? $_GET['databases'] : null;

?>

<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en" class="theme-dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windmill Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
          <!-- Desktop sidebar -->
       <?php require_once 'components/sidebar.php';?>
       <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
<?php require_once 'components/header.php';?>

            <main class="h-full overflow-y-auto">
            <div class="container grid px-6 mx-auto">

            </div>
            </main>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

</body>

</html>