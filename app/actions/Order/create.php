<?php
session_start();
require('../../database/connect.php');
require('../../services/functions.php');

global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if (isset($_POST)) {

    $hash_password = md5($_POST['password']);

    $user_id = auth();

    $user = $database->query("SELECT `password` FROM `users` WHERE `id` = '$user_id'")->fetch(2);

    if ($hash_password != $user['password']) {
        $_SESSION['errors'][] = "Пароль не совпадает";
    }
    var_dump($_SESSION['errors']);

    if (count($_SESSION['errors']) === 0) {
        $products = $database->query("SELECT *, cart.id AS cart_id FROM `cart` LEFT JOIN `products` ON `cart`.`product_id` = `products`.`id` WHERE `cart`.`user_id` = '$user_id'")->fetchAll(2);
        echo "<pre>";
        print_r($products);
        echo "</pre>";
        $sql = "INSERT INTO `orders` (`user_id`, `product_id`, `count`, `price`) VALUES (:user_id, :product_id, :count, :price)";

        foreach ($products as $item){
            $state = $database->prepare($sql);
            $state->execute([
                'user_id' => $user_id,
                'product_id' => $item['product_id'],
                'count' => $item['count'],
                'price' => $item['price']
            ]);
            var_dump($item);

            $delete_state = $database->prepare("DELETE FROM `cart` WHERE `id` = :id");
            $delete_state->execute([
                'id' => $item['cart_id'],
            ]);
        }

        redirect('cart.php');

    }
}

redirect('order.php');