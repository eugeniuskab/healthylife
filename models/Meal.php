<?php

class Meal {
    private $conn;
    private $table = "meals";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function create($meal_type, $meal_description, $calories) {
    $query = "INSERT INTO " . $this->table . " (meal_type, meal_description, calories) 
              VALUES (:meal_type, :meal_description, :calories)";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':meal_type', $meal_type);
    $stmt->bindParam(':meal_description', $meal_description);
    $stmt->bindParam(':calories', $calories);

    return $stmt->execute();
    }
}