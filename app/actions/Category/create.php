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
        if ($value == ''){
            $_SESSION['errors'][] = "Все поля должны быть заполнены";
            break;
        }
    }

    if (count($_SESSION['errors']) === 0){

        $sql = "INSERT INTO `categories` (`name`) VALUES (:name)";

        $state = $database->prepare($sql);
        $state->execute([
            'name' => $_POST['name']
        ]);

        redirect('add-product.php');
    }
}
redirect('');