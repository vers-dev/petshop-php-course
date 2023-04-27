<?php

function auth()
{
    return isset($_SESSION['AUTH_ID']) ? intval($_SESSION['AUTH_ID']) : false;
}

;

function isAdmin($id)
{
    global $database;

    $role = $database->query("SELECT `role` FROM `users` WHERE `id` = '$id'")->fetch(2);

    return $role['role'] == 'admin';
}

function redirect($url)
{
    $to = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $url;
    header("Location: $to");
    die();
}

function generateFilename($file)
{
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    $filename = uniqid() . '.' . $extension;

    return $filename;
}

function uploadFile($file, $to)
{
    if ($file) {
        $filename = generateFilename($file);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $to . $filename)){
            return 'public/products-image/' . $filename;
        }
    }

    return 'public/products-image/default.jpeg';
}



