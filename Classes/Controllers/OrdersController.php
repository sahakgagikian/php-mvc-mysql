<?php

namespace Controllers;

use DB\DBConnection;
use Models\OrderProductsModel;
use Models\OrdersModel;
use Models\UsersModel;

class OrdersController
{

    private $ordersModel;
    private $orderProductsModel;
    private $usersModel;

    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->orderProductsModel = new OrderProductsModel();
        $this->usersModel = new UsersModel();
    }

    public function addToCart()
    {
        $products = $_POST['data'];
        $_SESSION['products'] = json_decode($products, true);
        return json_encode(['success' => true]);
    }

    public function cart()
    {
        $firstName = $lastName = $email = "";
        $firstNameErr = $lastNameErr = $emailErr = "";
        $user_isOK = true;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["firstName"])) {
                $firstNameErr = "Your first name is required.";
                $user_isOK = false;
            } else {
                $firstName = $_POST["firstName"];
                if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
                    $firstNameErr = "Only letters and white spaces allowed.";
                    $user_isOK = false;
                }
            }

            if (empty($_POST["lastName"])) {
                $lastNameErr = "Your last name is required.";
                $user_isOK = false;
            } else {
                $lastName = $_POST["lastName"];
                if (!preg_match("/^[a-zA-Z-' ]*$/", $lastNameErr)) {
                    $lastNameErr = "Only letters and white spaces allowed.";
                    $user_isOK = false;
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "Your email is required.";
                $user_isOK = false;
            } else {
                $email = $_POST["email"];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format.";
                    $user_isOK = false;
                }
                if ($user_isOK) {
                    $this->usersModel->setUser($firstName, $lastName, $email);

                    $userIdSQL = 'SELECT max(id) as id FROM users WHERE email=:email';
                    $userIdStmt = DBConnection::getInstance()::connect()->prepare($userIdSQL);
                    $userIdStmt->execute(['email' => $email]);
                    $userId = $userIdStmt->fetch()['id'];
                    $sum = $_SESSION['sum'];
                    $orderDate = date("Y-m-d h:i:sa");
                    $this->ordersModel->setOrder($userId, $sum, $orderDate);

                    $orderIdSQL = 'SELECT max(id) as id FROM orders WHERE user_id=:user_id';
                    $orderIdStmt = DBConnection::getInstance()::connect()->prepare($orderIdSQL);
                    $orderIdStmt->execute(['user_id' => $userId]);
                    $orderId = $orderIdStmt->fetch()['id'];
                    foreach ($_SESSION['products'] as $product) {
                        $prodId = $product['id'];
                        $qty = $product['quantity'];
                        $this->orderProductsModel->setProductOrder($orderId, $prodId, $qty);
                    }
                }
            }
        }

        ob_start();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Views/cart.php';
        $output = ob_get_clean();
        return $output;
    }

    public function displayOrders()
    {
        $allOrders = $this->ordersModel->getOrdersData();
        ob_start();

        $formattedOrders = [];

        foreach ($allOrders as $order) {
            if (!isset($formattedOrders[$order['order_id']])) {
                $formattedOrders[$order['order_id']] = [
                    'order_id' => $order['order_id'],
                    'user_id' => $order['user_id'],
                    'first_name' => $order['first_name'],
                    'last_name' => $order['last_name'],
                    'email' => $order['email'],
                    'sum' => $order['sum'],
                    'order_date' => $order['order_date'],
                    'products' => []
                ];
            }
            $formattedOrders[$order['order_id']]['products'][] = [
                'id' => $order['product_id'],
                'name' => $order['name'],
                'description' => $order['description'],
                'price' => $order['price'],
                'qty' => $order['qty'],
            ];
        }
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Views/displayOrders.php';

        $output = ob_get_clean();
        return $output;
    }

}