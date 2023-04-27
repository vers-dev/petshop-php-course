<?php
session_start();

require('../../database/connect.php');
require('../../services/functions.php');

unset($_SESSION['errors']);
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
    $hash_password = md5($_POST['password']);

    // Проверка наличия пользователя в базе
    $user = $database->query("SELECT * FROM `users` WHERE `email` = \"$email\"")->fetch(2);
    if (!$user){
        $_SESSION['errors'][] = "Пользователь \"$email\" не найден";
    }

    // Проверка совпадния паролей
    if ($user && $hash_password != $user['password']){
        $_SESSION['errors'][] = 'Неверный пароль';
    }

    // Если нет ошибок - Авторизация
    if (count($_SESSION['errors']) === 0){
        $_SESSION['AUTH_ID'] = $user['id'];

        redirect('');
    }
}

redirect('auth.php');