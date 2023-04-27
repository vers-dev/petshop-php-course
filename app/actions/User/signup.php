<?php
session_start();

require('../../database/connect.php');
require('../../services/functions.php');

$_SESSION['errors'] = [];

if (isset($_POST)){

    // Проверка на пустоту полей
    foreach ($_POST as $value){
        if ($value == ''){
            $_SESSION['errors'][] = "Все поля должны быть заполнены";
            break;
        }
    }

    $email = $_POST['email'];
    $name = $_POST['name'];
    $hash_password = md5($_POST['password']);

    // Проверка наличия почты в базе
    $emailExist = $database->query("SELECT `email` FROM `users` WHERE `email` = \"$email\"")->fetch(2);
    if ($emailExist){
        $_SESSION['errors'][] = "Почта \"$email\" уже используется";
    }

    // Проверка пароля
    if (strlen($_POST['password']) < 6){
        $_SESSION['errors'][] = "Пароль должен быть больше 5 символов";
    }

    // Проверка на совпадение паролей
    if ($_POST['password'] != $_POST['re_password']){
        $_SESSION['errors'][] = "Пароли должены совпадать";
    }

    // Если нет ошибок, то записываем в базу
    if (count($_SESSION['errors']) === 0){

        $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name', \"$email\", '$hash_password')";

        $state = $database->prepare($sql);
        $state->execute();

        $_SESSION['AUTH_ID'] = $database->lastInsertId();

        redirect('');
    }
}

redirect('registration.php');