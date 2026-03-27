<?php

$page = $_GET['page'] ?? 'home';

$allowedPages = ['home', 'diet', 'exercise', 'contact'];

if (!in_array($page, $allowedPages)) {
    $page = 'home';
}

include 'includes/header.php';
include "views/$page.php";
include 'includes/footer.php';
