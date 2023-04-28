<?php
include('app/services/Base.php');

$user_id = auth();

$products = $database->query("SELECT * FROM `cart` LEFT JOIN `products` ON `cart`.`product_id` = `products`.`id` WHERE `cart`.`user_id` = '$user_id'")->fetchAll(2);
//echo "<pre>";
//print_r($products);
//echo "</pre>"
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
        <div class="admin-catalog">
            <div class="add">
                <h2>Товары</h2>
                <?php if(count($products) > 0): ?>
                    <a href="order.php">Заказать</a>
                <?php endif; ?>
            </div>
            <div class="catalog-items" id="catalog">
                <?php if(count($products) > 0): ?>
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
                                        <h4><?= $product['price'] * $product['count']; ?> ₽</h4>
                                        <p>Количество: <?= $product['count']; ?></p>
                                        <a href="app/actions/Product/delete.php?delete&id=<?= $product['id']; ?>"
                                           class="redbtn" onclick="return proverka()">удалить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h3>Корзина пуста</h3>
                <?php endif; ?>
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
