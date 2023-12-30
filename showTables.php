<?php require_once 'api/session.php';?>

<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en" class="theme-dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windmill Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <?php require_once 'components/sidebar.php'; ?>
        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
            <?php require_once 'components/header.php'; ?>

            <main class="h-full overflow-y-auto">
                <div class="container grid px-6 mt-10 mx-auto">

                    <!-- sql code html for selecting table "select * from table" -->
                    <code
                        class="text-lime-600 dark:text-lime-400 my-3 bg-gray-700 p-2">" SELECT * FROM <?php echo $selectedTable;?>; "</code>

                    <!-- Show the Table data in a flowbite table style based on the php get -->
                    <?php if ($selectedTable) {?>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <?php 
                                    // show the table columns in the table header
                                    $sql = "SHOW COLUMNS FROM $selectedTable";
                                    $response = $db->query($sql);
                                    while ($row = $response->fetch_assoc()) {
                                        echo "<th scope='col' class='px-6 py-3'>". $row['Field']. "</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                            // show the table data in the table body
                            $sql = "SELECT * FROM $selectedTable";
                            $response = $db->query($sql);
                            while ($row = $response->fetch_assoc()) {
                                echo '<tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">';
                                foreach ($row as $key => $value) {
                                    echo "<td class='px-4 py-3'>". $value. "</td>";
                                }
                                echo "</tr>";
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                    <?php }?>


                </div>
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

</body>

</html>