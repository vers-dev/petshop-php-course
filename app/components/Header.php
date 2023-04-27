<header>
    <div class="container">
        <div class="header">
            <a href="index.php" class="logo">Pets Food</a>
            <ul class="menu">
                <li><a href="#catalog" class="link">Каталог</a></li>
                <li><a href="" class="link">О нас</a></li>
                <li><a href="#sub" class="link">Акции</a></li>
                <?php if (auth()): ?>
                    <?php if (isAdmin($_SESSION['AUTH_ID'])): ?>
                        <li><a href="adminpanel.php" class="link">Админ</a></li>
                    <?php endif;?>
                <?php endif; ?>
            </ul>
            <ul class="menu">
                <?php if (auth()): ?>
                    <li><a href="" class="link">Корзина</a></li>
                    <li><a href="app/actions/User/logout.php" class="link">Выход</a></li>
                <?php else: ?>
                    <li><a href="auth.php" class="link">Войти</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>