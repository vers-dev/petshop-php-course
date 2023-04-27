<?php
session_start();
require('../../database/connect.php');
require('../../services/functions.php');

global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if (isset($_POST)) {

    // Проверка на пустоту полей
    foreach ($_POST as $key => $value) {
        if ($key == 'description' || $key == 'image') continue;

        if ($value == '') {
            $_SESSION['errors'][] = "Все поля должны быть заполнены";
            break;
        }
    }

    if ($_FILES['image']['size'] > 0) {
        $mimes = ['image/jpeg', 'image/png', 'image/jpg'];

        if (!in_array($_FILES['image']['type'], $mimes)) {
            $_SESSION['errors'][] = 'Картинка должны быть .jpg, .jpeg, .png';
        }
    }

    if (count($_SESSION['errors']) === 0) {

        $path = $_FILES['image']['size'] > 0 ? uploadFile($_FILES['image'], '../../../public/products-image/') : $_POST['img_path'];

        $sql = "UPDATE `products` SET 
                      `title` = :title, 
                      `description` = :description,
                      `price` = :price,
                      `category_id` = :category_id,
                      `img_path` = :img_path
                      WHERE `id` = :id";

        $state = $database->prepare($sql);
        $state->execute([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'category_id' => $_POST['category_id'],
            'img_path' => $path,
            'id' => $_POST['id']
        ]);

        redirect('product.php?id=' . $_POST['id']);
    }
}

redirect('adminpanel.php');