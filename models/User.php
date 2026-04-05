<?php

class User {

    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($username, $password) {

        $query = "INSERT INTO " . $this->table . " (username, password)
                  VALUES (:username, :password)";

        $stmt = $this->conn->prepare($query);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }

    public function findByUsername($username) {

        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countAll() {
    $query = "SELECT COUNT(*) as total FROM users";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>