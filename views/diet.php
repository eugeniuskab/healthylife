    <div class="container mt-4">
        <h2>Jedálniček</h2>

        <table class="table table-striped mt-3 table-rounded">
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
                            <a href="index.php?page=diet&edit=<?php echo $row['meal_id']; ?>" 
                            class="btn btn-outline-warning btn-sm px-2 py-0">
                            Edit
                            </a>
                        </td>
                        
                        <td>
                            <form method="POST" action="index.php?page=diet" style="display:inline;">
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
        <form method="POST" action="index.php?page=diet">

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

        <!-- tabuľka -->
        <h3 class="mt-5">Odporúčané potraviny</h3>

        <table class="table table-striped mt-3 table-rounded">
            <thead class="table">
                <tr>
                    <th>Potraviny</th>
                    <th>Príklad</th>
                    <th>Výhoda</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ovocie a zelenina</td>
                    <td>Jablko, špenát, mrkva</td>
                    <td>poskytujú vlákninu a vitamíny (A, C, K), podporujú trávenie, imunitu, zdravie kostí, zrak a pokožku</td>
                </tr>
                <tr>
                    <td>Celozrnné produkty</td>
                    <td>Ovos, celozrnný chlieb, hnedá ryža</td>
                    <td>obsahujú vlákninu a vitamíny skupiny B, stabilizujú hladinu cukru v krvi a dodávajú energiu</td>
                </tr>
                <tr>
                    <td>Bielkoviny</td>
                    <td>Kuracie prsia, losos, strukoviny</td>
                    <td>poskytujú bielkoviny a vitamíny (B12, D), podporujú rast svalov a regulujú hladinu cukru v krvi</td>
                </tr>
                <tr>
                    <td>Mliečne produkty alebo alternatívy</td>
                    <td>Nízkotučný jogurt, tvaroh, mandľové mlieko</td>
                    <td>obsahujú bielkoviny, vápnik a vitamíny (B2, D), posilňujú svaly a kosti a podporujú zdravie čriev</td>
                </tr>
                <tr>
                    <td>Zdravé tuky</td>
                    <td>Olivový olej, orechy, avokádo</td>
                    <td>poskytujú zdravé tuky a vitamíny (E, K), podporujú zdravie srdca, mozgu a metabolizmus</td>
                </tr>
            </tbody>
        </table>
    </div>