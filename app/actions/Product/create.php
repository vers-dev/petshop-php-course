<?php
session_start();
require('../../database/connect.php');
require('../../services/functions.php');

global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if (isset($_POST)){

    // Проверка на пустоту полей
    foreach ($_POST as $key => $value){
        if ($key == 'description' || $key == 'image') continue;

        if ($value == ''){
            $_SESSION['errors'][] = "Все поля должны быть заполнены";
            break;
        }
    }

    if (isset($_FILES['image'])){
        $mimes = ['image/jpeg', 'image/png', 'image/jpg'];

        if (!in_array($_FILES['image']['type'], $mimes)){
            $_SESSION['errors'][] = 'Картинка должны быть .jpg, .jpeg, .png';
        }
    }

    if (count($_SESSION['errors']) === 0){

        $path = uploadFile($_FILES['image'], '../../../public/products-image/');

        $sql = "INSERT INTO `products`(`title`, `description`, `price`, `img_path`, `category_id`, `user_id`) 
                VALUES (:title, :description, :price, :img_path, :category_id, :user_id)";

        $state = $database->prepare($sql);
        $state->execute([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'img_path' => $path,
            'category_id' => $_POST['category_id'],
            'user_id' => auth(),
        ]);

        redirect('');
    }
}

redirect('add-product.php');