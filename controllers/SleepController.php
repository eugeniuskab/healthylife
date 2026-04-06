<?php
require_once 'config/Database.php';
require_once 'models/Sleep.php';

class SleepController {

    private $sleep;

    public function __construct() {
        $db = new Database();
        $conn = $db->connect();
        $this->sleep = new Sleep($conn);
    }

    public function index() {

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['delete_id'])) {
                $this->sleep->delete($_POST['delete_id'], $user_id);
                header("Location: index.php?page=sleep");
                exit;
            }

            $this->sleep->create(
                $_POST['hours'],
                $_POST['date'],
                $user_id
            );

            header("Location: index.php?page=sleep");
            exit;
        }

        $result = $this->sleep->getAll($user_id);
        $avgSleep = $this->sleep->getAverageSleep($user_id);
        $monthlySleep = $this->sleep->getMonthlySleep($user_id);
        $weeklySleep = $this->sleep->getWeeklyAverage($user_id);

        require 'views/sleep.php';
    }
}
?>