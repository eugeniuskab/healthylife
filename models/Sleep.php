<?php

class Sleep {

    private $conn;
    private $table = "sleep_logs";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll($user_id) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE user_id = :user_id 
                  ORDER BY date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt;
    }

    // user functions
    public function create($hours, $date, $user_id) {
        $query = "INSERT INTO " . $this->table . " (hours, date, user_id)
                  VALUES (:hours, :date, :user_id)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hours', $hours);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':user_id', $user_id);

        return $stmt->execute();
    }

    public function delete($sleep_id, $user_id) {
        $query = "DELETE FROM " . $this->table . " 
                  WHERE sleep_id = :sleep_id AND user_id = :user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sleep_id', $sleep_id);
        $stmt->bindParam(':user_id', $user_id);

        return $stmt->execute();
    }

    // admin dashboard analytics functions
    public function getAverageSleep($user_id) {
    $query = "SELECT AVG(hours) as avg_sleep 
              FROM " . $this->table . " 
              WHERE user_id = :user_id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return round($stmt->fetch(PDO::FETCH_ASSOC)['avg_sleep'], 2);
    }

    public function getMonthlySleep($user_id) {
    $query = "SELECT SUM(hours) as total_sleep 
              FROM " . $this->table . " 
              WHERE user_id = :user_id 
              AND MONTH(date) = MONTH(CURRENT_DATE())
              AND YEAR(date) = YEAR(CURRENT_DATE())";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total_sleep'] ?? 0;
    }

    public function getWeeklyAverage($user_id) {
    $query = "SELECT AVG(hours) as avg_week 
              FROM " . $this->table . " 
              WHERE user_id = :user_id 
              AND date >= DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return round($stmt->fetch(PDO::FETCH_ASSOC)['avg_week'], 2);
    }

    public function getGlobalAverageSleep() {
    $query = "SELECT AVG(hours) as avg_sleep FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return round($stmt->fetch(PDO::FETCH_ASSOC)['avg_sleep'], 2);
    }

    public function getTopSleepers() {
    $query = "
        SELECT users.username, AVG(sleep_logs.hours) as avg_sleep
        FROM sleep_logs
        JOIN users ON sleep_logs.user_id = users.user_id
        GROUP BY users.user_id
        ORDER BY avg_sleep DESC
        LIMIT 3
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
    }

    public function getTotalSleepEntries() {
    $query = "SELECT COUNT(*) as total FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>