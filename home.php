<?php
require_once 'api/session.php';
?>

<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en" class="theme-dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windmill Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <script src="js/tailwindcss.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />

    <script src="//unpkg.com/alpinejs" defer></script>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
       <?php require_once 'components/sidebar.php';?>
        <!-- Mobile sidebar -->
        <!-- Backdrop -->

       
        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
<?php require_once 'components/header.php';?>

            <main class="h-full overflow-y-auto">
                <div class="container grid px-6 mx-auto">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Database
                    </h2>
                    <!-- CTA -->
                    <form action="home.php" method="get">
                        <input type="text" value="<?php echo $selectedDatabase ?>" name="databases" hidden>
                        <label for="underline_select" class="sr-only">Select a Table</label>
                        <select id="underline_select" onchange="this.form.submit()" name="table" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option selected>Choose a Table</option>
                            <?php
                            $selectedTable = $_GET['table'];
                            $tables = 'show tables from ' . $selectedDatabase;
                            $response = $db->query($tables);
                            while ($row = $response->fetch_assoc()) {
                                $isSelected = ($selectedTable == $row['Tables_in_' . $selectedDatabase]) ? ' selected' : '';
                                echo "<option value='{$row['Tables_in_' .$selectedDatabase]}'{$isSelected}>{$row['Tables_in_' .$selectedDatabase]}</option>";
                            }
                            ?>

                        </select>
                    </form>
                    <!-- Charts -->
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Seed
                    </h2>


                    <form class="mx-auto w-full grid grid-cols-1 gap-3" action='insert.php' method="post">
                        <?php
                        if (isset($selectedTable)) {
                            // Query to get column details excluding columns with AUTO_INCREMENT
                            $sql3 = "SELECT COLUMN_NAME, DATA_TYPE
                       FROM information_schema.COLUMNS
                        WHERE TABLE_SCHEMA = '{$selectedDatabase}'
                        AND TABLE_NAME = '{$selectedTable}'
                       AND EXTRA NOT LIKE '%auto_increment%'";

                            $response3 = $db->query($sql3);
                            $seeder = new DatabaseSeeder($db);
                            $faker = Faker\Factory::create();
                            // Get all formatters (methods that generate fake data)
                            $formatterMethods = get_class_methods($faker);
                            sort($formatterMethods);
                            while ($row = $response3->fetch_assoc()) {
                        ?>

                                <div class="grid grid-cols-3 gap-3">
                                    <div>
                                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Field</label>
                                        <input type="text" id="small-input" name="<?php echo $row['COLUMN_NAME']; ?>" value="<?php echo $row['COLUMN_NAME']; ?>" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            <?php echo $row['COLUMN_NAME']; ?></label>
                                        <select id="small-input" name="type_<?php echo $row['COLUMN_NAME']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected>Choose a data type</option>
                                            <option value="name">Name</option>
                                            <option value="address">Address</option>
                                            <option value="text">Text</option>
                                            <option value="email">Email</option>
                                            <option value="phoneNumber">Phone Number</option>
                                            <option value="company">Company</option>
                                            <option value="date">Date</option>
                                            <option value="userName">Username</option>
                                            <option value="password">Password</option>
                                            <option value="domainName">Domain Name</option>
                                            <option value="url">URL</option>
                                            <option value="ipv4">IPv4 Address</option>
                                            <option value="ipv6">IPv6 Address</option>
                                            <option value="creditCardNumber">Credit Card Number</option>
                                            <option value="city">City</option>
                                            <option value="state">State</option>
                                            <option value="country">Country</option>
                                            <option value="postcode">Postcode</option>
                                            <option value="latitude">Latitude</option>
                                            <option value="longitude">Longitude</option>
                                            <option value="currencyCode">Currency Code</option>
                                            <option value="ean13">EAN-13 Barcode</option>
                                            <option value="ean8">EAN-8 Barcode</option>
                                            <option value="isbn13">ISBN-13</option>
                                            <option value="isbn10">ISBN-10</option>
                                            <option value="jobTitle">Job Title</option>
                                            <option value="colorName">Color Name</option>
                                            <option value="hexColor">Hex Color</option>
                                            <option value="rgbColor">RGB Color</option>
                                            <option value="sentences">Sentences</option>
                                            <option value="uuid">UUID</option>
                                        </select>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <input type="text" value="<?php echo $selectedDatabase; ?>" name="selectedDatabase" hidden>
                        <input type="text" value="<?php echo $selectedTable; ?>" name="selectedTable" hidden>
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            How many Rows you want to put</label>
                        <input type="number" id="small-input" name="numberOfEntries" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <button type="submit" name="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Seed</button>
                    </form>



                    <div class="grid gap-6 mb-8 md:grid-cols-2">

                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php if (isset($successMessage)) { ?>
        <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">Item moved successfully.</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    <?php } ?>
    <script>
        // This script will automatically submit the form when a database is selected
        document.getElementById('databases').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
   
    <script src="js/flowbite-2-2-1.js"></script>

</body>

</html>