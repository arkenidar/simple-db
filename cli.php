<?php

require_once 'database.php';

class CLI
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function run()
    {
        while (true) {
            $this->showMenu();
            $choice = trim(fgets(STDIN));

            switch ($choice) {
                case '1':
                    $this->addUser();
                    break;
                case '2':
                    $this->listUsers();
                    break;
                case '3':
                    $this->updateUser();
                    break;
                case '4':
                    $this->deleteUser();
                    break;
                case '5':
                    echo "Goodbye!\n";
                    exit(0);
                default:
                    echo "Invalid choice. Please try again.\n\n";
            }
        }
    }

    private function showMenu()
    {
        echo "=== Simple Database CLI ===\n";
        echo "1. Add User\n";
        echo "2. List Users\n";
        echo "3. Update User\n";
        echo "4. Delete User\n";
        echo "5. Exit\n";
        echo "Enter your choice: ";
    }

    private function addUser()
    {
        echo "\n--- Add User ---\n";
        echo "Enter name: ";
        $name = trim(fgets(STDIN));
        echo "Enter email: ";
        $email = trim(fgets(STDIN));

        if ($this->db->addUser($name, $email)) {
            echo "User added successfully!\n\n";
        } else {
            echo "Failed to add user.\n\n";
        }
    }

    private function listUsers()
    {
        echo "\n--- Users List ---\n";
        $users = $this->db->listUsers();

        if (empty($users)) {
            echo "No users found.\n\n";
            return;
        }

        printf("%-5s %-20s %-30s %-20s\n", "ID", "Name", "Email", "Created At");
        echo str_repeat("-", 75) . "\n";

        foreach ($users as $user) {
            printf(
                "%-5s %-20s %-30s %-20s\n",
                $user['id'],
                $user['name'],
                $user['email'],
                $user['created_at']
            );
        }
        echo "\n";
    }

    private function updateUser()
    {
        echo "\n--- Update User ---\n";
        echo "Enter user ID: ";
        $id = trim(fgets(STDIN));
        echo "Enter new name: ";
        $name = trim(fgets(STDIN));
        echo "Enter new email: ";
        $email = trim(fgets(STDIN));

        if ($this->db->updateUser($id, $name, $email)) {
            echo "User updated successfully!\n\n";
        } else {
            echo "Failed to update user.\n\n";
        }
    }

    private function deleteUser()
    {
        echo "\n--- Delete User ---\n";
        echo "Enter user ID: ";
        $id = trim(fgets(STDIN));

        if ($this->db->deleteUser($id)) {
            echo "User deleted successfully!\n\n";
        } else {
            echo "Failed to delete user.\n\n";
        }
    }
}

$cli = new CLI();
$cli->run();
