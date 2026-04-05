<?php

require_once 'helpers/Auth.php';
require_once 'models/Meal.php';
require_once 'models/User.php';

class AdminController {

    private $meal;
    private $user;

    public function __construct() {

        $db = new Database();
        $conn = $db->connect();

        $this->meal = new Meal($conn);
        $this->user = new User($conn);
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