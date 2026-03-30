<?php
require_once 'config/Database.php';
require_once 'models/Meal.php';

$db = new Database();
$conn = $db->connect();

$meal = new Meal($conn);

$editMeal = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete_id'])) {

        $meal_id = $_POST['delete_id'];

        if ($meal->delete($meal_id)) {
            header("Location: index.php?page=diet");
            exit;
        } else {
            echo "Error deleting meal";
        }

    } else {

        $meal_type = $_POST['meal_type'];
        $meal_description = $_POST['meal_description'];
        $calories = $_POST['calories'];

        if ($meal->create($meal_type, $meal_description, $calories)) {
            header("Location: index.php?page=diet");
            exit;
        } else {
            echo "Error adding meal";
        }
    }
}

$result = $meal->getAll();
?>

    <div class="container mt-4">
        <h2>Jedálniček</h2>

        <table class="table table-striped mt-3 table-rounded">
            <thead class="table-dark">
                <tr>
                    <th>Jedlo</th>
                    <th>Popis</th>
                    <th>Kalórie</th>
                    <th>Vymazať</th>
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
                            <form method="POST" action="index.php?page=diet" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $row['meal_id']; ?>">
                                <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-0"
                                    onclick="return confirm('Ste si istý?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3 class="mt-5 mb-3">Pridať jedlo</h3>
        <form method="POST" action="index.php?page=diet" class="p-3 border rounded">

            <div class="mb-3">
                <input type="text" name="meal_type" placeholder="Typ (Raňajky, Obed...)" required class="form-control bg-white">
            </div>

            <div class="mb-3">
                <input type="text" name="meal_description" placeholder="Jedlo" required class="form-control bg-white">
            </div>

            <div class="mb-3">
                <input type="number" name="calories" placeholder="Kalórie" required class="form-control bg-white">
            </div>

            <button type="submit" class="btn btn-primary">Pridať</button>
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