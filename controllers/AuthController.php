<?php
require_once 'config/Database.php';
require_once 'models/User.php';

class AuthController {

    private $user;

    public function __construct() {
        $db = new Database();
        $conn = $db->connect();
        $this->user = new User($conn);
    }

    public function register() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->user->create($username, $password);

            header("Location: index.php?page=login");
            exit;
        }

        require 'views/register.php';
    }

    public function login() {

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->user->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: index.php?page=diet");
                exit;

            } else {
                $error = "Používateľské meno alebo heslo je nesprávne, prosím skúste znova";
            }
        }

        require 'views/login.php';
    }

    public function logout() {

        session_destroy();

        header("Location: index.php?page=login");
        exit;
    }
}