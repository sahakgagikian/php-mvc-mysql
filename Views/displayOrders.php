<?php
require('./Views/header.php');
require('./Views/style.php');
require('./Views/script.php');
?>

    <table>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>E-mail</th>
            <th>Sum</th>
            <th>Order date</th>
            <th>Product details</th>
        </tr>
        <?php foreach ($formattedOrders as $formattedOrder): ?>
            <tr>
                <td><?= $formattedOrder['order_id'] ?></td>
                <td><?= $formattedOrder['user_id'] ?></td>
                <td><?= $formattedOrder['first_name'] ?></td>
                <td><?= $formattedOrder['last_name'] ?></td>
                <td><?= $formattedOrder['email'] ?></td>
                <td><?= $formattedOrder['sum'] ?></td>
                <td><?= $formattedOrder['order_date'] ?></td>
                <td>
                    <table>
                        <tr>
                            <th>Product ID</th>
                            <th>Product name</th>
                            <th>Product description</th>
                            <th>Product price</th>
                            <th>Product quantity</th>
                        </tr>
                        <?php foreach ($formattedOrder['products'] as $product): ?>
                            <tr class="nested">
                                <td><?= $product['id'] ?></td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['description'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <td><?= $product['qty'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


<?php require('./Views/footer.php');