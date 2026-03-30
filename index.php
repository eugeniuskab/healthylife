<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/Database.php';

$db = new Database();
$conn = $db->connect();


$page = $_GET['page'] ?? 'home';

$allowedPages = ['home', 'diet', 'exercise', 'contact'];

if (!in_array($page, $allowedPages)) {
    $page = 'home';
}

include 'includes/header.php';
if ($page === 'diet') {

    require_once 'controllers/DietController.php';
    $controller = new DietController();
    $controller->index();

} else {
    include "views/$page.php";
}
include 'includes/footer.php';
?>