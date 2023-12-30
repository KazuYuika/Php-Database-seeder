<?php require_once 'api/session.php';

$message = '';

if (isset($_GET['sql_query'])) {
    $sql_query = $_GET['sql_query'];

    $result = $db->query($sql_query);

    if ($result === false) {
        // Set an error message if the query failed
        $message = "Error executing query: " . htmlspecialchars($db->error);
    } else {
        // Set a success message if the query was successful
        $message = "Query executed successfully.";
    }
}
?>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/sql/sql.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/show-hint.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/sql-hint.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/show-hint.min.css">
<style>
    .CodeMirror {
  background-color: #1a202c; /* Tailwind's gray-900 */
  color: #f7fafc; /* Tailwind's gray-50 */
  border-radius: 0.5rem;
  height: 100px;
}

/* Customizing the gutter (line number area) */
.CodeMirror-gutters {
  background-color: #2d3748; /* Tailwind's gray-800 */
  border-right: 1px solid #4a5568; /* Tailwind's gray-700 */
}

/* Customizing the cursor */
.CodeMirror-cursor {
  border-left: 1px solid #edf2f7; /* Tailwind's gray-200 */
}
</style>
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
                        Sql canvas
                    </h2>
                    <div class="sql-canvas">
                        <form action="sqlCanvas.php" method="get">
                        <input type="text" name="databases" value="<?php echo $_GET['databases'];?>" hidden>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Sql command (use CRTL+SPACE for hints)</label>
<textarea name="sql_query" id="sql-canvas" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type your SQL query here...">
   
</textarea>
                            
                            <button type="submit" name="submit" class="text-gray-900 my-3 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Execute</button>
                        </form>
                        <div class="message">
                        <?php 
    if (!empty($message)) {
        // Display the message in a div
        echo '<div id="toast-success" class="flex items-center w-full p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">'.$messaage.' "'.$_GET['sql_query'].'"</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>';
    }
    ?>
                        </div>
                        <?php if (isset($result) && $result): ?>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 p-4">
                            <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <?php foreach ($result->fetch_fields() as $field): ?>
                                    <th class="px-6 py-3"><?php echo htmlspecialchars($field->name); ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="bg-white border-b text-center dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <?php foreach ($row as $value): ?>
                                    <td><?php echo htmlspecialchars($value); ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        </div>
                        <?php endif; ?>
                    </div>


                </div>
            </main>
        </div>
    </div>
    <script>
  // Define custom SQL keywords for autocomplete
  var customSqlKeywords = ["SELECT", "UPDATE", "INSERT INTO", "DELETE FROM", "CREATE TABLE", "DROP TABLE", "ALTER TABLE", "INDEX", "VIEW", "TRIGGER", "PROCEDURE", "FUNCTION"];

  // Extend the existing SQL hint function to include custom keywords
  var originalSqlHint = CodeMirror.hint.sql;
  CodeMirror.hint.sql = function(editor) {
    var hintResult = originalSqlHint(editor);
    var cursor = editor.getCursor();
    var token = editor.getTokenAt(cursor);

    // Filter the list based on the current token string
    var filteredList = customSqlKeywords.filter(function(keyword) {
      return keyword.toLowerCase().startsWith(token.string.toLowerCase());
    });

    // Combine the filtered list with the default suggestions
    hintResult.list = filteredList.concat(hintResult.list);

    return hintResult;
  };

  // Initialize CodeMirror with SQL mode and autocomplete
  var editor = CodeMirror.fromTextArea(document.getElementById("sql-canvas"), {
    mode: 'text/x-sql',
    indentWithTabs: true,
    smartIndent: true,
    lineNumbers: true,
    matchBrackets: true,
    autofocus: true,
    extraKeys: {"Ctrl-Space": "autocomplete"}
  });
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

</body>

</html>