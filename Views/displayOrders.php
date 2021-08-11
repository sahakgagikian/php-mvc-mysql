<?php
require('./Views/header.php');
require('./Views/style.php');
require('./Views/script.php');
?>

<table>
    <tr>
        <th>Order ID</th>
        <th>User ID</th>
        <th>Sum</th>
        <th>Order date</th>
    </tr>
    <?php foreach ($allOrders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= $order['user_id'] ?></td>
            <td><?= $order['sum'] ?></td>
            <td><?= $order['order_date'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require('./Views/footer.php');