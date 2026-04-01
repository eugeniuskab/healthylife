<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Healthy Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex gap-2" href="index.php?page=home">
                <img src="img/logo.png" alt="Logo" height="32">
                <span>Healthy Life</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php?page=home">Domov</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=diet">Jedálniček</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=exercise">Šport</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=contact">Kontakt</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item d-flex align-items-center ms-3">
                        <span class="text-white me-2">
                            <?php echo $_SESSION['username']; ?>
                        </span>
                        <a class="btn btn-primary ms-2" href="index.php?page=logout">
                            Odhlásiť sa
                        </a>
                    </li>

                    <?php else: ?>

                    <li class="nav-item ms-3">
                        <a class="btn btn-primary" href="index.php?page=login">
                            Prihlásiť sa
                        </a>
                    </li>

                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>