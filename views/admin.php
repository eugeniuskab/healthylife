<div class="container mt-4">

    <h2 class="mb-4">Prehľad systému</h2>
    <div class="row">

        <div class="col-md-4">
            <div class="card text-center p-3 shadow">
                <h5>Používatelia</h5>
                <h2><?php echo $totalUsers; ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3 shadow">
                <h5>Jedlá</h5>
                <h2><?php echo $totalMeals; ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3 shadow">
                <h5>Správy</h5>
                <h2><?php echo $totalMessages; ?></h2>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card text-center p-3 shadow">
                <h5>Kalórie spolu</h5>
                <h2><?php echo $totalCalories; ?> kcal</h2>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card text-center p-3 shadow">
                <h5>Priemer jedál na používateľa</h5>
                <h2><?php echo $avgMeals; ?></h2>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card text-center p-3 shadow">
                <h5>Priemerné kalórie na jedlo</h5>
                <h2><?php echo $avgCalories; ?> kcal</h2>
            </div>
        </div>
    </div>

    
    <table class="table table-striped mt-4 table-rounded">
        <thead class="table-dark">
            <tr>
                <th>Jedlo</th>
                <th>Popis</th>
                <th>Kalórie</th>
                <th>Upraviť</th>
                <th>Vymazať</th>
                <?php if ($_SESSION['role'] === 'admin') : ?>
                    <th>Používateľ</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['meal_type']; ?></td>
                    <td><?php echo $row['meal_description']; ?></td>
                    <td>
                        <span class="badge bg-primary">
                            <?php echo $row['calories']; ?> kcal
                        </span>
                    </td>

                    <td>
                        <a href="index.php?page=admin&edit=<?php echo $row['meal_id']; ?>" 
                        class="btn btn-outline-warning btn-sm px-2 py-0">
                        Edit
                        </a>
                    </td>
                            
                    <td>
                        <form method="POST" action="index.php?page=admin" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?php echo $row['meal_id']; ?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-0"
                                onclick="return confirm('Ste si istý?')">
                                Delete
                            </button>
                        </form>
                    </td>

                    <?php if ($_SESSION['role'] === 'admin') : ?>
                        <td><?php echo $row['username']; ?></td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3 class="mt-5">Pridať / Upraviť jedlo</h3>
    <form method="POST" action="index.php?page=admin">

        <input type="hidden" name="meal_id" 
            value="<?php echo $editMeal['meal_id'] ?? ''; ?>">

        <input type="text" name="meal_type"
            value="<?php echo $editMeal['meal_type'] ?? ''; ?>"
            placeholder="Typ (Raňajky, Obed...)" required class="form-control mb-2 bg-white">

        <input type="text" name="meal_description"
            value="<?php echo $editMeal['meal_description'] ?? ''; ?>"
            placeholder="Jedlo" required class="form-control mb-2 bg-white">

        <input type="number" name="calories"
            value="<?php echo $editMeal['calories'] ?? ''; ?>"
            placeholder="Kalórie" required class="form-control mb-2 bg-white">

        <button type="submit" class="btn btn-primary">
            <?php echo $editMeal ? 'Upraviť' : 'Pridať'; ?>
        </button>
    </form>

    <h3 class="mt-5">Počet jedál na používateľa</h3>
    <table class="table table-striped mt-3 table-rounded">
        <thead class="table-dark">
            <tr>
                <th>Používateľ</th>
                <th>Počet jedál</th>
            </tr>
        </thead>
        <tbody>

            <?php while($row = $mealsPerUser->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td>
                        <span class="badge bg-primary">
                            <?php echo $row['total_meals']; ?>
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>

        </tbody>
    </table>

    <h3 class="mt-5">Správy od používateľov</h3>
    <?php if (!empty($messages)) : ?>

    <table class="table table-striped mt-3 table-rounded">
        <thead class="table-dark">
            <tr>
                <th>Meno</th>
                <th>Email</th>
                <th>Správa</th>
                <th>Dátum</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($messages as $msg) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($msg['name']); ?></td>
                    <td><?php echo htmlspecialchars($msg['email']); ?></td>
                    <td><?php echo htmlspecialchars($msg['message']); ?></td>
                    <td><?php echo htmlspecialchars($msg['date']); ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <?php else : ?>
        <p class="mt-3">Žiadne správy zatiaľ.</p>
    <?php endif; ?>

</div>        