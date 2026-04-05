<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/Database.php';

$db = new Database();
$conn = $db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['page']) && $_GET['page'] === 'contact') {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $date = date('Y-m-d H:i:s');

    $record = "Meno: $name | Email: $email | Správa: $message | Dátum: [$date]" . PHP_EOL;

    file_put_contents("data/messages.txt", $record, FILE_APPEND);

    header("Location: index.php?page=thankyou");
    exit();
}


$page = $_GET['page'] ?? 'home';

$allowedPages = ['home', 'diet', 'exercise', 'contact', 'login', 'register', 'logout', 'thankyou', 'admin'];

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

} elseif ($page === 'admin') {

    require_once 'controllers/AdminController.php';
    $controller = new AdminController();
    $controller->index();

} else {

    include "views/$page.php";
}
?>
</main>
<?php include 'includes/footer.php'; ?>
