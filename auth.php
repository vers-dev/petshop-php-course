<?php
include('app/services/Base.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/components/MetaTags.php'); ?>
    <title>Войти</title>
</head>
<body>
<?php include('app/components/Header.php'); ?>

<div class="auth">
        <div class="container">
            <p class="title">Войти</p>
            <form action="/app/actions/User/signin.php" method="post" name="auth">
                <div class="auth-items">
                    <input type="email" name="email" placeholder="Email" class="ainput">
                    <input type="password" name="password" placeholder="Пароль"  class="ainput">
                    <input type="submit" value="Войти"  class="abtn">
                </div>
            </form>
            <?php include('app/components/FormErorrs.php'); ?>
            <div class="noacc">
                <p>Нет аккаунта?</p>
                <a href="registration.php">Регистрация</a>
            </div>
        </div>
    </div>

<?php include('app/components/Footer.php'); ?>

</body>
</html>