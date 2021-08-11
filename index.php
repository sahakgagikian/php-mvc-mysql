<?php

use Controllers\OrdersController;
use Controllers\ProductsController;

require('Includes/autoLoad.php');

session_start();
$path = $_GET['path'] ?? '';

if ($path == '') {
    $productsController = new ProductsController();
    echo $productsController->home();
} elseif ($path == 'addprod') {
    $productsController = new ProductsController();
    echo $productsController->addProduct();
} elseif ($path == 'addToCart') {
    $ordersController = new OrdersController();
    echo $ordersController->addToCart();
} elseif ($path == 'cart') {
    $ordersController = new OrdersController();
    echo $ordersController->cart();
} elseif ($path == 'display-orders') {
    $ordersController = new OrdersController();
    echo $ordersController->displayOrders();
}
