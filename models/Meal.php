<?php

class Meal {
    private $conn;
    private $table = "meals";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll($user_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt;
    }

    public function create($meal_type, $meal_description, $calories, $user_id) {
    $query = "INSERT INTO " . $this->table . " (meal_type, meal_description, calories, user_id) 
              VALUES (:meal_type, :meal_description, :calories, :user_id)";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':meal_type', $meal_type);
    $stmt->bindParam(':meal_description', $meal_description);
    $stmt->bindParam(':calories', $calories);
    $stmt->bindParam(':user_id', $user_id);

    return $stmt->execute();
    }

    public function delete($meal_id, $user_id) {
    $query = "DELETE FROM " . $this->table . " WHERE meal_id = :meal_id AND user_id = :user_id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':meal_id', $meal_id);
    $stmt->bindParam(':user_id', $user_id);

    return $stmt->execute();
    }

    public function update($meal_id, $type, $desc, $calories, $user_id) {
    $query = "UPDATE " . $this->table . " 
              SET meal_type = :type,
                  meal_description = :desc,
                  calories = :calories
              WHERE meal_id = :id AND user_id = :user_id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':desc', $desc);
    $stmt->bindParam(':calories', $calories);
    $stmt->bindParam(':id', $meal_id);
    $stmt->bindParam(':user_id', $user_id);

    return $stmt->execute();
    }

    public function getById($meal_id, $user_id) {
    $query = "SELECT * FROM " . $this->table . " WHERE meal_id = :meal_id AND user_id = :user_id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':meal_id', $meal_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllAdmin() {
    $query = "SELECT meals.*, users.username 
              FROM meals
              JOIN users ON meals.user_id = users.user_id";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
    }

    public function deleteAsAdmin($meal_id) {
    $query = "DELETE FROM " . $this->table . " WHERE meal_id = :meal_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':meal_id', $meal_id);

    return $stmt->execute();
    }

    public function updateAsAdmin($meal_id, $type, $desc, $calories) {
    $query = "UPDATE " . $this->table . " 
              SET meal_type = :type,
                  meal_description = :desc,
                  calories = :calories
              WHERE meal_id = :meal_id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':desc', $desc);
    $stmt->bindParam(':calories', $calories);
    $stmt->bindParam(':meal_id', $meal_id);

    return $stmt->execute();
    }

    public function getByIdAdmin($meal_id) {
    $query = "SELECT * FROM " . $this->table . " WHERE meal_id = :meal_id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':meal_id', $meal_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}