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

    // user functions
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

    // admin functions
    public function getAllAdmin() {
    $query = "SELECT meals.*, users.username 
              FROM meals
              JOIN users ON meals.user_id = users.user_id
              ORDER BY meals.meal_id DESC";

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

    // admin dashboard analytics functions
    public function countAll() {
    $query = "SELECT COUNT(*) as total FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalCalories() {
    $query = "SELECT SUM(calories) as total FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    public function getMealsPerUser() {
    $query = "
        SELECT users.username, COUNT(meals.meal_id) as total_meals
        FROM users
        LEFT JOIN meals ON users.user_id = meals.user_id
        GROUP BY users.user_id
        ORDER BY total_meals DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
    }

    public function getAverageMealsPerUser() {
    $query = "
        SELECT AVG(user_meals) as avg_meals
        FROM (
            SELECT COUNT(meal_id) as user_meals
            FROM meals
            GROUP BY user_id
        ) as subquery";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return round($stmt->fetch(PDO::FETCH_ASSOC)['avg_meals'], 2);
    }

    public function getAverageCalories() {
    $query = "SELECT AVG(calories) as avg_calories FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return round($stmt->fetch(PDO::FETCH_ASSOC)['avg_calories'], 2);
    }
}
?>