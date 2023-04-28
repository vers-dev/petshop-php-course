<?php
session_start();
require('../../database/connect.php');
require('../../services/functions.php');

global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if (isset($_GET['product_id'])) {

    $product_id = intval($_GET['product_id']);
    $user_id = auth();

    $cart = $database->query("SELECT * FROM `cart` WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'")->fetch(2);
//    Если не пустая карзина
    if (!empty($cart)) {
        $query = "UPDATE `cart` SET count = count + 1 WHERE `id` = " . $cart['id'];
        $state = $database->prepare($query);
        $state->execute();
    }

//    Если пустая
    if (empty($cart)) {
        $sql = "INSERT INTO `cart` (`product_id`, `user_id`) VALUES (:product_id, :user_id)";

        $state = $database->prepare($sql);
        $state->execute([
            'product_id' => $product_id,
            'user_id' => $user_id,
        ]);
    }

    redirect('cart.php');
}

redirect('product.php');