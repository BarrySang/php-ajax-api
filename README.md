# PHP AJAX API Demo

A simple PHP project that demonstrates how to build a lightweight CRUD-style API using AJAX and prepared SQL statements. The project includes a front-end demo page, server-side PHP scripts, and a small helper layer for generating and executing SQL.

## Features

- PHP + PDO database access
- Prepared statements for safer queries
- AJAX-based requests from the browser
- Simple CRUD examples for create, read, update, and delete
- Environment-based database configuration via `.env`
- Small helper classes for SQL generation and file-based config loading

## Project Structure

```text
php-ajax-api/
├── client/
│   ├── index.html
│   └── script.js
├── server/
│   ├── create.php
│   ├── read.php
│   ├── update.php
│   ├── delete.php
│   ├── DbCredentials.php
│   ├── FileReader.php
│   ├── lib.php
│   ├── Request.php
│   ├── RequestHandler.php
│   └── SQLGenerator.php
├── .env
├── .gitignore
└── README.md
```

## Requirements

- PHP 7.4+ (or later)
- MySQL or MariaDB database
- A web server or PHP built-in server

## Database Setup

Create a MySQL database and a `users` table similar to this:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

Create a `.env` file in the project root with your database credentials:

```env
SERVERNAME=localhost
USERNAME=root
PASSWORD=your_password
DBNAME=your_database_name
```

The file is intentionally ignored by Git via `.gitignore`.

## Running the Project

From the project root, start the PHP development server:

```bash
php -S localhost:8000
```

Then open the demo page in the browser:

```text
http://localhost:8000/client/index.html
```

## How It Works

### Client-side AJAX

The browser-side JavaScript in `client/script.js` sends a POST request to one of the PHP scripts in the `server` directory.

### Server-side processing

Each PHP endpoint demonstrates a different database action:

- `server/create.php` - inserts a new user
- `server/read.php` - reads a user by ID
- `server/update.php` - updates a user record
- `server/delete.php` - deletes a user record

The `RequestHandler` class wraps the database connection and prepared statement execution logic.

## Example Calls

### Create

The `SQLGenerator` class builds an insert statement such as:

```php
$sqlGen = new SQLGenerator("insert", "users", [
    "firstname" => "john",
    "lastname" => "doe",
    "username" => "johndoe",
    "email" => "john3@gmail.com",
    "password" => "john123"
]);
```

### Read

```php
$sql = "SELECT * FROM users WHERE id = :id";
$read = new RequestHandler($sql, ["id" => 6]);
$result = $read->executeQuery();
```

### Update

```php
$sql = "UPDATE users SET email = :email WHERE id = :id";
$requestHandler = new RequestHandler($sql, [
    "email" => "john5@gmail.com",
    "id" => 6
]);
```

### Delete

```php
$sql = "DELETE FROM users WHERE id = :id";
$requestHandler = new RequestHandler($sql, ["id" => 6]);
```

## Notes

This project is a learning/demo application rather than a production-ready API. It does not include:

- authentication or authorization
- input validation and sanitization beyond prepared statements
- a formal routing system
- JSON response formatting standards
- automated testing

It is best used as a simple reference for connecting a PHP backend with AJAX-driven browser requests.

## License

This project is provided as-is for educational purposes.
