<?php

use DB\DBConnection;
use Controllers\ProductsController;

spl_autoload_register('autoLoader');

function autoLoader($className) {
    $className = str_replace('\\', '/', $className);

    $path = './Classes/';
    $extension = '.php';
    $fullPath = $path . $className . $extension;

    require_once $fullPath;
}
