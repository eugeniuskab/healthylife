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
}
?>