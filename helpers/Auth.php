<?php

class Auth {

    public static function checkAdmin() {

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        if ($_SESSION['role'] !== 'admin') {
            header("Location: index.php?page=diet");
            exit;
        }
    }
}