<?php

require_once 'helpers/Auth.php';
require_once 'models/Meal.php';
require_once 'models/User.php';
require_once 'models/Sleep.php';

class AdminController {

    private $meal;
    private $user;

    public function __construct() {

        $db = new Database();
        $conn = $db->connect();

        $this->meal = new Meal($conn);
        $this->user = new User($conn);
        $this->sleep = new Sleep($conn);
    }

    public function index() {

        Auth::checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['delete_id'])) {
                $this->meal->deleteAsAdmin($_POST['delete_id']);
                header("Location: index.php?page=admin");
                exit;
            }

            if (!empty($_POST['meal_id'])) {
                $this->meal->updateAsAdmin(
                    $_POST['meal_id'],
                    $_POST['meal_type'],
                    $_POST['meal_description'],
                    $_POST['calories']
                );
                header("Location: index.php?page=admin");
                exit;
            }
        }

        $editMeal = null;
        if (isset($_GET['edit'])) {
            $editMeal = $this->meal->getByIdAdmin($_GET['edit']);
        }

        $messages = [];
        $file = 'data/messages.txt';

        if (file_exists($file)) {

            $lines = file($file, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $line) {

                $parts = explode(' | ', $line);

                $data = [
                    'name' => '',
                    'email' => '',
                    'message' => '',
                    'date' => ''
                ];

                foreach ($parts as $part) {

                    if (str_starts_with($part, 'Meno:')) {
                        $data['name'] = trim(str_replace('Meno:', '', $part));
                    }

                    if (str_starts_with($part, 'Email:')) {
                        $data['email'] = trim(str_replace('Email:', '', $part));
                    }

                    if (str_starts_with($part, 'Správa:')) {
                        $data['message'] = trim(str_replace('Správa:', '', $part));
                    }

                    if (str_starts_with($part, 'Dátum:')) {
                        $date = trim(str_replace('Dátum:', '', $part));
                        $data['date'] = trim($date, '[]');
                    }
                }

                $messages[] = $data;
            }
        }

        $totalMeals = $this->meal->countAll();
        $totalUsers = $this->user->countAll();
        $totalMessages = count($messages);
        $totalCalories = $this->meal->getTotalCalories();

        $mealsPerUser = $this->meal->getMealsPerUser();
        $avgMeals = $this->meal->getAverageMealsPerUser();
        $avgCalories = $this->meal->getAverageCalories();

        $globalSleep = $this->sleep->getGlobalAverageSleep();
        $totalSleepEntries = $this->sleep->getTotalSleepEntries();
        $topSleepers = $this->sleep->getTopSleepers();

        $topSleepersArray = $topSleepers->fetchAll(PDO::FETCH_ASSOC);
        $topUser = $topSleepersArray[0] ?? null;

        if (file_exists($file)) {
            $lines = file($file, FILE_IGNORE_NEW_LINES);
            $totalMessages = count($lines);
        }

        $result = $this->meal->getAllAdmin();
        require 'views/admin.php';
    }

    public function deleteMeal() {

        Auth::checkAdmin();

        $this->meal->deleteAsAdmin($_POST['meal_id']);

        header("Location: index.php?page=admin");
        exit;
    }
}
?>