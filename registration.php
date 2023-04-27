<?php
include('app/services/Base.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/components/MetaTags.php'); ?>
    <title>Регистрация</title>
</head>
<body>
<?php include('app/components/Header.php'); ?>

<div class="auth">
    <div class="container">
        <p class="title">Регистрация</p>
        <form action="/app/actions/User/signup.php" method="post" name="reg">
            <div class="auth-items">
                <input type="text" name="name" placeholder="Имя" class="ainput">
                <input type="email" name="email" placeholder="E-mail" class="ainput">
                <input type="password" name="password" placeholder="Пароль" class="ainput">
                <input type="password" name="re_password" placeholder="Повторите Пароль" class="ainput">
                <input type="submit" value="Регистрация" class="abtn">
            </div>
        </form>
        <?php include('app/components/FormErorrs.php'); ?>
        <div class="noacc">
            <p>Есть аккаунт?</p>
            <a href="auth.php">Войти</a>
        </div>
    </div>
</div>

<?php include('app/components/Footer.php'); ?>

</body>
</html>