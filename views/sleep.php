<div class="container mt-4">

    <h2 class="mb-3">Spánok</h2>

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card text-center p-3 shadow">
                <h5>Priemerný spánok</h5>
                <h2><?php echo $avgSleep; ?> h</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3 shadow">
                <h5>Tento mesiac</h5>
                <h2><?php echo $monthlySleep; ?> h</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3 shadow">
                <h5>Posledných 7 dní</h5>
                <h2><?php echo $weeklySleep; ?> h</h2>
            </div>
        </div>

    </div>

    <table class="table table-striped mt-3 table-rounded">
        <thead class="table-dark">
            <tr>
                <th>Dátum</th>
                <th>Hodiny spánku</th>
                <th>Vymazať</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['hours']; ?> h</td>
                    <td>
                        <form method="POST" action="index.php?page=sleep">
                            <input type="hidden" name="delete_id" value="<?php echo $row['sleep_id']; ?>">
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3 class="mt-4">Pridať spánok</h3>

    <form method="POST" action="index.php?page=sleep">
        <input type="number" step="0.1" name="hours" placeholder="Hodiny" class="form-control mb-2" required>
        <input type="date" name="date" class="form-control mb-2" required>

        <button class="btn btn-primary">Pridať</button>
    </form>
</div>