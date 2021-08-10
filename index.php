<?php

use Controllers\OrdersController;
use Controllers\ProductsController;

require('Includes/autoLoad.php');
require('./Views/header.php');
require('./Views/style.php');
require('./Views/script.php');

session_start();
$path = $_GET['path'] ?? '';

if ($path == '') {
    echo ProductsController::home();
} elseif ($path == 'addprod') {
    echo ProductsController::addProduct();
} elseif ($path == 'addToCart') {
    echo OrdersController::addToCart();
} elseif ($path == 'cart') {
    echo OrdersController::cart();
} elseif ($path == 'display-orders') {
    echo OrdersController::displayOrders();
}

require('./Views/footer.php');
