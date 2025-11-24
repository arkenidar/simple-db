<?php

class Database
{
    private $pdo;
    private $dbFile = 'simple.db';

    public function __construct()
    {
        try {
            $this->pdo = new PDO("sqlite:{$this->dbFile}");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTable();
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage() . "\n");
        }
    }

    private function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $this->pdo->exec($sql);
    }

    public function addUser($name, $email)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
            $stmt->execute([$name, $email]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "\n";
            return false;
        }
    }

    public function listUsers()
    {
        $stmt = $this->pdo->query("SELECT * FROM users ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateUser($id, $name, $email)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            return $stmt->execute([$name, $email, $id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "\n";
            return false;
        }
    }
}
