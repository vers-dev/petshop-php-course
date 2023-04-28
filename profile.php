<?php
include('app/services/Base.php');

if (!auth()) {
    redirect('');
}
$user_id = auth();
$user = $database->query("SELECT * FROM `users` WHERE `id` = '$user_id'")->fetch(2);
$products = $database->query("SELECT *, `orders`.`id` AS `order_id` FROM `orders` LEFT JOIN `products` ON `orders`.`product_id` = `products`.`id` WHERE `orders`.`user_id` = '$user_id'")->fetchAll(2);
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
        <div class="adminpanel-content">
            <h2>Профиль пользователя</h2>

            <ul>
                <li><?= $user['name'];?></li>
                <li><?= $user['email'];?></li>
                <li><?= $user['created_at'];?></li>
                <li><?= $user['role'];?></li>
            </ul>

            <h2>Заказы</h2>

            <ol>
                <?php foreach ($products as $item): ?>
                    <li>
                        <?= $item['title']; ?>
                        <?= $item['price']; ?>
                        <img src="<?= $item['img_path']; ?>">
                    </li>
                    <hr>
                <?php endforeach; ?>
            </ol>
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