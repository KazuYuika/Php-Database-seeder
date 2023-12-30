# Database Seeder

This is a PHP application that allows generating and inserting fake data into database tables using the [Faker](https://github.com/fakerphp/faker) library. 

## Features

- Connect to MySQL databases
- Select existing databases and tables  
- Leverage Faker API to generate fake data
- Easy configuration and customization
- Seed multiple tables with one click
- Supports multiple data types (names, addresses, text, numbers etc.)

## Overview

The app contains the following files:

- `index.php` - Login page to enter database credentials
- `home.php` - Main dashboard to select database and tables  
- `seeder.php` - Seeders class to generate and insert fake data
- `composer.json` - Composer dependencies
- `composer.lock` - Locked Composer dependencies

## Usage

1. Run `composer install`
2. Go to `/index.php` and enter your database credentials
3. Select a database and table to seed
4. Generated fake data will be inserted into the table

## Important Notes

- Edit `.env` file to configure database credentials
- Supports MySQL databases only
- Requires PHP 7.4+

## Customization

- Use Faker documenation to customize data generators
- Edit `seeder.php` to add more seeder methods

### Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL database

## Credits

This project was created by [Yuka](https://github.com/yourusername). 

The fake data generation is powered by:

- [FakerPHP](https://github.com/fakerphp/faker)
- [Composer](https://getcomposer.org/)

## License

This project is open source and available under the [MIT License](LICENSE.md).

## Contact

If you have any questions or issues, please open an issue on GitHub or contact me directly at `marianolukkanit17@gmail.com`

## Contributing

Contributions are welcome! Feel free to fork this repo, work on any improvements and send in pull requests.

Some areas that could be improved:

- Adding support for more database types 
- Creating a UI for better user experience
- Increasing the variety of fake data generators
- Optimizing performance for large database tables
- Writing more tests