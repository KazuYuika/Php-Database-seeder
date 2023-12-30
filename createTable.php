<?php require_once 'api/session.php';?>

<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en" class="theme-dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windmill Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="js/tailwindcss.js"></script>
  
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
                    <?php if (isset($_SESSION['status'])){
                            // display toast message from session using flowbite
                            echo '<div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="sr-only">Check icon</span>
                            </div>
                            <div class="ms-3 text-sm font-normal">table created successfully.</div>
                            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>';
                            unset($_SESSION['status']);
                    

                    }
                    
                    ?>

                    <h1 class="text-xl font-bold ">Create Table</h1>

                    <form class="w-full mx-auto" action="api/sqlCreateTable.php" method="POST">
                        <input type="text" name="selectedDatabase" id="selectedDatabase"
                            value="<?php echo $selectedDatabase;?>" hidden>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="floating_text" id="floating_text"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required />
                            <label for="floating_text"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Table Name</label>
                        </div>

                        <h1 class="text-xl font-bold">Collumns</h1>
                        <div id="columnsContainer">
                            <div class="grid md:grid-cols-6 md:gap-6">
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="floating_first_name[]" id="floating_first_name"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="floating_first_name"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        name</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <select name="floating_data_type[]" id="floating_data_type"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option value="varchar">varchar</option>
                                        <option value="int">int</option>
                                        <option value="float">float</option>
                                        <option value="date">date</option>
                                        <option value="datetime">datetime</option>
                                        <option value="text">text</option>
                                        <option value="time">time</option>
                                        <option value="timestamp">timestamp</option>
                                        <option value="tinyint">tinyint</option>
                                        <option value="smallint">smallint</option>
                                        <option value="mediumint">mediumint</option>
                                        <option value="bigint">bigint</option>
                                        <option value="tinytext">tinytext</option>
                                        <option value="mediumtext">mediumtext</option>
                                        <option value="longtext">longtext</option>
                                        <option value="char">char</option>
                                        <option value="tinyblob">tinyblob</option>
                                        <option value="blob">blob</option>
                                        <option value="mediumblob">mediumblob</option>
                                        <option value="longblob">longblob</option>
                                        <option value="enum">enum</option>
                                        <option value="set">set</option>
                                        <option value="binary">binary</option>
                                        <option value="varbinary">varbinary</option>
                                        <option value="geometry">geometry</option>
                                        <option value="point">point</option>
                                        <option value="linestring">linestring</option>
                                        <option value="polygon">polygon</option>
                                        <option value="multipoint">multipoint</option>
                                        <option value="multilinestring">multilinestring</option>
                                        <option value="multipolygon">multipolygon</option>
                                        <option value="geometrycollection">geometrycollection</option>
                                        <option value="json">json</option>
                                        <option value="jsonb">jsonb</option>
                                        <option value="uuid">uuid</option>
                                        <option value="year">year</option>
                                        <option value="bit">bit</option>
                                        <option value="varbit">varbit</option>
                                        <option value="numeric">numeric</option>
                                        <option value="decimal">decimal</option>

                                    </select>
                                    <label for="floating_data_type"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        data Type</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="floating_size[]" id="floating_size"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="floating_size"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Length</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <Select name="floating_Index[]" id="floating_Index[]"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option value=""></option>

                                        <option value="PRIMARY">Primary</option>
                                    </Select>
                                    <label for="floating_Index"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Index</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <div class="flex items-center mb-4">
                                        <input id="default-checkbox" type="checkbox" value="" name="auto_increment[]"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="default-checkbox"
                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Auto
                                            Increment</label>
                                    </div>
                                </div>
                                <!-- action div delete and add svg flowbite style -->
                                <div class="flex items-center justify-center">


                                    <button type="button" name="deleteColumn" id="deleketeColumn" class="deleteColumn text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline
                                focus:ring-red-300 font-medium rounded-lg p-3
                                text-center dark:bg-red-500 dark:hover:bg-red-600 dark:
                                focus:ring-red-800"><svg class="w-3 h-3 text-gray-800 dark:text-white"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg></button>

                                </div>


                            </div>
                        </div>


                        <button type="submit" name="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                            <button type="button" name="addColumnButton" id="addColumnButton" class="text-white bg-lime-600 hover:bg-lime-700 focus:ring-4 focus:outline
                                focus:ring-lime-300 font-medium rounded-lg p-3
                                text-center dark:bg-lime-500 dark:hover:bg-lime-600 dark:
                            focus:ring-blue-800"><svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg></button>

                    </form>
                   

                </div>
            </main>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="js/flowbite-2-2-1.js"></script>
   

</body>

</html>