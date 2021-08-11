<?php

namespace Controllers;

use Models\ProductsModel;

class ProductsController
{

    private $model;

    public function __construct()
    {
        $this->model = new ProductsModel();
    }

    public function home()
    {
        $products = $this->model->getAll();
        ob_start();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Views/home.php';
        $output = ob_get_clean();
        return $output;
    }

    public function addProduct()
    {
        $name = $description = $price = "";
        $nameErr = $descriptionErr = $priceErr = "";
        $prod_isOK = true;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
                $prod_isOK = false;
            } else {
                $name = $_POST["name"];
                if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                    $nameErr = "Only letters and white spaces allowed.";
                    $prod_isOK = false;
                }
            }

            if (empty($_POST["description"])) {
                $descriptionErr = "Description is required.";
                $prod_isOK = false;
            } else {
                $description = $_POST["description"];
            }

            if (empty($_POST["price"])) {
                $priceErr = "Price is required";
                $prod_isOK = false;
            } else {
                $price = $_POST["price"];
                if (!preg_match("/[+-]?([0-9]*[.])?[0-9]+/", $price)) {
                    $priceErr = "Only numerical values allowed.";
                    $prod_isOK = false;
                }
                if ($prod_isOK) {
                    $this->model->setProduct($name, $description, $price);
                }
            }
        }

        ob_start();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Views/addProduct.php';
        $output = ob_get_clean();
        return $output;
    }

}