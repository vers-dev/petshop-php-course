<?php
include('app/services/Base.php');

if (!(auth() && isAdmin($_SESSION['AUTH_ID']))) {
    redirect('');
}

$users = $database->query("SELECT * FROM `users`")->fetchAll(2);
$categories = $database->query("SELECT * FROM `categories`")->fetchAll(2);
$products = $database->query("SELECT * FROM `products`")->fetchAll(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/components/MetaTags.php'); ?>

    <title>Admin Panel</title>
</head>
<body>
<?php include('app/components/Header.php'); ?>

<div class="adminpanel">
    <div class="container">
        <p class="title">Панель администратора</p>
        <div class="admin-users">
            <div class="add">
                <h2>Пользователи</h2>
                <a href="userlist.php">+ показать всех</a>
            </div>

            <table>
                <tr>
                    <th>Почта</th>
                    <th>Имя</th>
                    <th>Роль</th>
                    <th>Дата регистрации</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['role']; ?></td>
                        <td><?= $user['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="admin-categories">
            <div class="add">
                <h2>Категории</h2>
                <a href="add-category.php">+ добавить категорию</a>
            </div>
            <div class="categories-items">
                <?php foreach ($categories as $cat): ?>
                    <div class="categories-item">
                        <p><?= $cat['name']; ?></p>
                        <a href="app/actions/Category/delete.php?delete&id=<?= $cat['id']; ?>" onclick="return proverka()" ;>удалить</a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="admin-catalog">
                <div class="add">
                    <h2>Товары</h2>
                    <a href="add-product.php">+ добавить товар</a>
                </div>
                <div class="catalog-items" id="catalog">
                    <?php foreach ($products as $product): ?>
                        <div class="catalog-item">
                            <div class="item">
                                <div class="catalog-img">
                                    <img src="<?= $product['img_path']; ?>" alt="">
                                </div>
                                <div class="catalog-text">
                                    <a href="product.php?id=<?= $product['id']; ?>"><?= $product['title']; ?></a>
                                    <p><?= $product['description']; ?></p>
                                    <div class="price">
                                        <h4><?= $product['price']; ?> ₽</h4>
                                        <a href="update-product.php?id=<?= $product['id']; ?>" class="cbtn">изменить</a>
                                        <a href="app/actions/Product/delete.php?delete&id=<?= $product['id']; ?>" class="redbtn" onclick="return proverka()">удалить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('app/components/Footer.php'); ?>

<script type="text/javascript">
    function proverka() {
        if (confirm("are you sure?")) {
            return true;
        } else {
            return false;
        }
    }
</script>
</body>
</html>