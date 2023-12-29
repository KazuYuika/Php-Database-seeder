<?php 
require_once 'vendor/autoload.php';
class DatabaseSeeder {
    private $mysqli;
    private $faker;

    public function __construct($conn) {
        $this->mysqli = $conn;
        $this->faker = Faker\Factory::create();
    }

    // Map MySQL column types to Faker formatters
    private function getFakerData($type) {
        switch ($type) {
            case 'int':
            case 'int(11)':
                return $this->faker->randomNumber(9, true); // Generates a number with 9 digits
            case 'varchar':
            case 'varchar(255)':
                return $this->faker->text(255);
            // Add more mappings as needed
            default:
                throw new InvalidArgumentException("Unknown formatter for MySQL type: {$type}");
        }
    }

    public function seed($table, $fields, $numberOfEntries) {
        $fieldNames = implode(', ', array_keys($fields));
        $fieldValues = implode(', ', array_fill(0, count($fields), '?'));

        $query = "INSERT INTO $table ($fieldNames) VALUES ($fieldValues)";
        $stmt = $this->mysqli->prepare($query);

        for ($i = 0; $i < $numberOfEntries; $i++) {
            $values = [];
            foreach ($fields as $field => $type) {
                $values[] = $this->getFakerData($type);
            }
            $stmt->bind_param(str_repeat('s', count($fields)), ...$values);
            $stmt->execute();
        }

        $stmt->close();
    }
}
// Usage
// Assuming $conn is your existing mysqli connection
// $seeder = new DatabaseSeeder($conn);

// Define the fields and corresponding Faker methods for the table you want to populate
// $fields = [
//     'name' => 'name',
//     'email' => 'email',
//     'address' => 'address',
//     'phone' => 'phoneNumber',
//     'website' => 'domainName',
//     'company' => 'company'
// ];

// $seeder->seed('your_table', $fields, 50); // Populates the specified table with 50 entries

?>