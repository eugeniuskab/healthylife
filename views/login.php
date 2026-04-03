<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4 shadow">
                <h2 class="mb-4 text-center">Prihlásenie</h2>
                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong><?php echo $error; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <form method="POST" action="index.php?page=login">
                    <input type="text" name="username"
                           placeholder="Username"
                           required
                           class="form-control mb-3">

                    <input type="password" name="password"
                           placeholder="Heslo"
                           required
                           class="form-control mb-3">

                    <button type="submit" class="btn btn-primary w-100">
                        Prihlásiť sa
                    </button>
                </form>
                <a href="index.php?page=register"
                   class="btn btn-outline-secondary w-100 mt-3">
                    Zaregistrovať sa
                </a>
            </div>
        </div>
    </div>
</div>