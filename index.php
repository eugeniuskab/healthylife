<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/Database.php';

$db = new Database();
$conn = $db->connect();


$page = $_GET['page'] ?? 'home';

$allowedPages = ['home', 'diet', 'exercise', 'contact', 'login', 'register', 'logout'];

if (!in_array($page, $allowedPages)) {
    $page = 'home';
}
?>
<?php include 'includes/header.php'; ?>

<main class="flex-grow-1">

<?php
if ($page === 'diet') {

    require_once 'controllers/DietController.php';
    $controller = new DietController();
    $controller->index();

} elseif ($page === 'login') {

    require_once 'controllers/AuthController.php';
    $controller = new AuthController();
    $controller->login();

} elseif ($page === 'register') {

    require_once 'controllers/AuthController.php';
    $controller = new AuthController();
    $controller->register();

} elseif ($page === 'logout') {

    require_once 'controllers/AuthController.php';
    $controller = new AuthController();
    $controller->logout();

} else {

    include "views/$page.php";
}
?>
</main>
<?php include 'includes/footer.php'; ?>
