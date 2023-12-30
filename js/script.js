function addNewColumn() {
    const columnsContainer = document.getElementById('columnsContainer');
    const newColumnHtml = `
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
`;
    columnsContainer.insertAdjacentHTML('beforeend', newColumnHtml);
}

// Event listener for the Add Column button
document.getElementById('addColumnButton').addEventListener('click', addNewColumn);
// Function to delete a column
function deleteColumn(event) {
    // Check if the clicked element has the 'deleteColumn' class
    if (event.target.classList.contains('deleteColumn')) {
        // Find the closest parent grid container and remove it
        event.target.closest('.grid').remove();
    }
}

// Event listener for the Add Column button
document.getElementById('addColumnButton').addEventListener('click', addNewColumn);

// Event delegation for dynamically added delete buttons
document.getElementById('columnsContainer').addEventListener('click', deleteColumn);

 