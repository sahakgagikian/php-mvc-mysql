<?php
require('./Views/header.php');
require('./Views/style.php');
require('./Views/script.php');

$products = $_SESSION["products"];
count($products);
$i = 0;
$total = 0;
?>

<?php foreach ($products as $product): ?>
    <div class='prod' data-prod-parent="<?= $product['id'] ?>">
        <table>
            <tr>
                <td>
                    <p><strong>Product: </strong><?= $product['name'] ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong>Description: </strong><?= $product['description'] ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong>Price: </strong><?= $product['price'] ?></p>
                </td>
            </tr>
        </table>
        <div>Quantity:
            <input
                class="qty"
                type="number"
                min="1"
                max="10"
                value="<?= $products[$i]['quantity'] ?>"
                data-id="<?=  $product["id"] ?>"
            >
            <tr>
                <td>
                    <p><strong>Sum: </strong><?= $products[$i]['quantity'] * $product['price'] ?></p>
                </td>
            </tr>
        </div>
        <?php
        $total += (float)$products[$i]['quantity'] * (float)$product['price'];
        $i++;
        //      ?>
    </div>
<?php endforeach; ?>
<?php $_SESSION['sum'] = $total; ?>
    <div style="font-size: 48px; color: red;">Total: <?= $total ?></div>

<?php if (count($products) != 0): ?>
    <form method="post" action="/cart">
        <div>First name: </div><input type="text" name="firstName" value="<?= $firstName ?>">
        <span class="error">* <?= $firstNameErr ?></span>
        <br><br>
        <div>Last name: </div><input type="text" name="lastName" value="<?= $lastName ?>">
        <span class="error">* <?= $lastNameErr ?></span>
        <br><br>
        <div>Email: </div><input type="text" name="email" value="<?= $email ?>">
        <span class="error">* <?= $emailErr ?></span>
        <br><br>
        <input type="submit" name="submit" value="Confirm order">
    </form>
<?php endif; ?>

<?php require('./Views/footer.php');
