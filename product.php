<?php
include('app/services/Base.php');

if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    $product = $database->query("SELECT *, `products`.`id` AS `product_id`, `categories`.`name` AS `category_name` FROM `products`
        LEFT JOIN `categories` ON `products`.`category_id` = `categories`.`id`
        LEFT JOIN `users` ON `products`.`user_id` = `users`.`id`
        WHERE `products`.`id` = $id")->fetch(2);
    var_dump($product);

    if ($product['status_id'] != 2) redirect('');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/components/MetaTags.php'); ?>

    <title>Product</title>
</head>
<body>

<?php include('app/components/Header.php'); ?>

<div class="product">
    <div class="container">
        <div class="product-items">
            <div class="p-img">
                <div class="p-img-mini">
                    <img src="<?= $product['img_path']; ?>" alt="">
                    <img src="<?= $product['img_path']; ?>" alt="">
                    <img src="<?= $product['img_path']; ?>" alt="">
                </div>
                <img src="<?= $product['img_path']; ?>" alt="">
            </div>
            <div class="p-text">
                <h3><?= $product['title']; ?></h3>
                <p><?= $product['name']; ?>:<?= $product['email'] ?></p>
                <p><?= $product['category_name']; ?></p>
                <p><?= $product['description']; ?></p>
                <div class="product-price">
                    <h4><?= $product['price']; ?> ₽</h4>
                    <div class="product-button">
                        <a href="app/actions/Cart/create.php?product_id=<?= $product['product_id']; ?>" class="bbtn">В корзину</a>
                    </div>
                </div>
            </div>
        </div>
        <hr class="line">
    </div>
</div>
<?php include('app/components/Footer.php'); ?>

</body>
</html>