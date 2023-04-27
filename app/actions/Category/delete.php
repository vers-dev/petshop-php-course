<?php
session_start();
require('../../database/connect.php');
require('../../services/functions.php');

global $database;

if (!(auth() && isAdmin($_SESSION['AUTH_ID']))) redirect('');

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if (isset($_GET['delete'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM `categories` WHERE `id` = '$id'";

    $state = $database->prepare($sql);
    $state->execute();

    redirect('adminpanel.php');
}
redirect('adminpanel.php');
