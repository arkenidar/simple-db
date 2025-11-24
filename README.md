# Simple Database CLI

A simple PHP CLI application using SQLite and PDO for database operations.

## Features

- Add users (name and email)
- List all users
- Update user information
- Delete users
- SQLite database with PDO
- Interactive CLI menu

## Requirements

- PHP 7.0 or higher
- SQLite3 extension
- PDO extension

## Usage

Run the application:

```bash
php cli.php
```

## Database Structure

The application creates a `simple.db` SQLite database with a `users` table:

- id (INTEGER PRIMARY KEY AUTOINCREMENT)
- name (TEXT NOT NULL)
- email (TEXT NOT NULL UNIQUE)
- created_at (DATETIME DEFAULT CURRENT_TIMESTAMP)
