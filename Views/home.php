<h1>All products</h1>

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
                    <p><strong>Description : </strong><?= $product['description'] ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong>Price : </strong><?= $product['price'] ?></p>
                </td>
            </tr>
        </table>
        <div>Quantity: <input class="qty" type="number" min="1" max="10" value="1" data-id="<?=  $product["id"] ?>"></div>
        <input
            type='button'
            class='btn-input add-to-cart'
            value="Add to cart"
            data-selected="0"
            data-id="<?=  $product["id"] ?>"
            data-name="<?=  $product["name"] ?>"
            data-description="<?=  $product["description"] ?>"
            data-price="<?=  $product["price"] ?>">
    </div>
<?php endforeach; ?>

<br>
<input type='button' class="btn-input" id="make-order" value='Make an order'>
<a href="/addprod">
    <input type='button' class="btn-input" value='Add product'>
</a>
