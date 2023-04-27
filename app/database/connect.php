<?php

try{
    $host = 'localhost';
    $dbname = 'petshop_db';
    $username = 'root';
    $password = '';

    $database = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", $username, $password);
    return $database;
} catch (PDOException $err){
    die("Ошибка подключение к бд: " . $err->getMessage());
}