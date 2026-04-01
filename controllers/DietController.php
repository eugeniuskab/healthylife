<?php
require_once 'config/Database.php';
require_once 'models/Meal.php';

class DietController {

    private $meal;

    public function __construct() {
        $db = new Database();
        $conn = $db->connect();
        $this->meal = new Meal($conn);
    }

    public function index() {

        if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?page=login");
        exit;
        }

        $user_id = $_SESSION['user_id'];

        // POST (create / update / delete)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['delete_id'])) {
                $this->meal->delete($_POST['delete_id'], $user_id);
                header("Location: index.php?page=diet");
                exit;
            }

            if (!empty($_POST['meal_id'])) {
                $this->meal->update(
                    $_POST['meal_id'],
                    $_POST['meal_type'],
                    $_POST['meal_description'],
                    $_POST['calories'],
                    $user_id
                );
                header("Location: index.php?page=diet");
                exit;
            }

            $this->meal->create(
                $_POST['meal_type'],
                $_POST['meal_description'],
                $_POST['calories'],
                $user_id
            );

            header("Location: index.php?page=diet");
            exit;
        }

        // GET (edit)
        $editMeal = null;

        if (isset($_GET['edit'])) {
            $editMeal = $this->meal->getById($_GET['edit'], $user_id);
        }

        // view
        $result = $this->meal->getAll($user_id);

        require_once 'views/diet.php';
    }
}