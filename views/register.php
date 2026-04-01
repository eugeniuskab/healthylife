<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4 shadow">
                <h2 class="mb-4 text-center">Registrácia</h2>
                <form method="POST" action="index.php?page=register">

                    <input type="text" name="username"
                           placeholder="Username"
                           required
                           class="form-control mb-3">

                    <input type="password" name="password"
                           placeholder="Password"
                           required
                           class="form-control mb-3">

                    <button type="submit" class="btn btn-primary w-100">
                        Zaregistrovať sa
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>