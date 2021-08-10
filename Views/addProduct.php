<form method="post" action="/addprod">
    <div>Name:</div><input type="text" name="name" value="<?= $name ?>">
    <span class="error">* <?= $nameErr ?></span>
    <br><br>
    <div>Description:</div><textarea name="description" rows="5" cols="40"><?= $description ?></textarea>
    <span class="error">* <?= $descriptionErr ?></span>
    <br><br>
    <div>Price:</div><input type="text" name="price" value="<?= $price ?>">
    <span class="error">* <?= $priceErr ?></span>
    <br><br>
    <input type="submit" name="submit" value="Add Product">
</form>