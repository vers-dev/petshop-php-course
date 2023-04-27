<?php
include('app/services/Base.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/components/MetaTags.php') ?>
    <title>Добавить категорию</title>
</head>
<body>
    <?php include('app/components/Header.php'); ?>

    <div class="auth">
        <div class="container">
            <p class="title">Добавить категорию</p>
            <form action="/app/actions/Category/create.php" method="post">
                <div class="auth-items">
                    <input type="text" name="name" placeholder="Название" class="ainput">
                    <input type="submit" value="Добавить" class="abtn">
                </div>
            </form>
        </div>
    </div>

    <?php include('app/components/Footer.php'); ?>
</body>
</html>