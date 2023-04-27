<?php
include('app/services/Base.php');

if (isset($_GET['sort'])){
    $cat = $_GET['category_id'];
    $products = $database->query("SELECT * FROM `products` WHERE `status_id` = 2 AND `category_id` = '$cat'")->fetchAll(2);
} else{
    $products = $database->query("SELECT * FROM `products` WHERE `status_id` = 2")->fetchAll(2);
}

if (isset($_GET['filter_by'])){
    $filter_attr = $_GET['filter_by'];
    $products = $database->query("SELECT * FROM `products` WHERE `status_id` = 2 ORDER BY $filter_attr")->fetchAll(2);
}

$categories = $database->query("SELECT * FROM `categories`")->fetchAll(2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/components/MetaTags.php'); ?>
    <title>PETS FOOD</title>
</head>
<body>
<!-- header -->
<?php include('app/components/Header.php'); ?>
<!-- header -->

<!-- banner -->
<div class="banner">
    <div class="container">
        <div class="banner-items">
            <div class="banner-text">
                <p>Еда для вашего <span>питомца!</span></p>
                <div class="banner-button">
                    <a href="#catalog" class="bbtn">Заказать</a>
                </div>
            </div>
            <div class="banner-img">
                <img src="media/imgs/banner/banner.png" alt="">
            </div>
        </div>
        <hr class="line">
    </div>
</div>
<!-- banner -->


<!-- catalog -->
<div class="catalog" id="catalog">
    <div class="container">
        <div class="catalog-title">
            <p class="title">Каталог</p>
            <?php foreach ($categories as $cat): ?>
                <a href="/index.php?sort=true&category_id=<?= $cat['id']; ?>#catalog" class=""><?= $cat['name']; ?></a>
            <?php endforeach; ?>
            <a href="/index.php#catalog" class="showall">Показать все</a>
            <form method="get">
                <select name="filter_by">
                    <option value="title ASC">По названию A-Я</option>
                    <option value="title DESC">По названию Я-А</option>
                    <option value="price ASC">По возрастанию</option>
                    <option value="price DESC">По убыванию</option>
                </select>
                <button type="submit">Показать</button>
            </form>
        </div>
        <div class="catalog-items" >
            <?php foreach ($products as $product): ?>
                <div class="catalog-item">
                    <a href="product.php?id=<?= $product['id']; ?>" class="item">
                        <div class="catalog-img">
                            <img src="<?= $product['img_path']; ?>" alt="">
                        </div>
                        <div class="catalog-text">
                            <h3><?= $product['title']; ?></h3>
                            <p><?= $product['description']; ?></p>
                            <div class="price">
                                <h4><?= $product['price']; ?> ₽</h4>
<!--                                <a href="" class="cbtn">В корзину</a>-->
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- catalog -->


<!-- sub -->
<div class="subscribe">
    <div class="container">
        <div class="sub-items" id="sub">
            <div class="sub-text">
                <p class="title">Подпишитесь на рассылку и получите скидку <span>10%</span> на первый заказ!</p>
                <div class="sub-form">
                    <form action="" class="form">
                        <input type="email" placeholder="E-mail" class="input">
                        <input type="submit" value="Подписаться" class="sbtn">
                    </form>
                </div>
            </div>
            <div class="sub-img">
                <img src="media/imgs/sub/pets.png" alt="">
            </div>
        </div>
        <hr class="line">
    </div>
</div>

<?php include('app/components/Footer.php'); ?>
<!-- sub -->
</body>
</html>