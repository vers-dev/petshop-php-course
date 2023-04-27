<?php
include('app/services/Base.php');

if (!isset($_GET['id'])) redirect('');

$id = $_GET['id'];

$product = $database->query("SELECT * FROM `products` WHERE `id` = '$id'")->fetch(2);
$categories = $database->query("SELECT * FROM `categories`")->fetchAll(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/components/MetaTags.php'); ?>
    <title>Редактировать</title>
</head>
<body>
<?php include('app/components/Header.php'); ?>

<div class="auth">
    <div class="container">
        <p class="title">Редактировать товар</p>
        <form action="/app/actions/Product/update.php" method="post" enctype="multipart/form-data">
            <div class="auth-items">
                <input type="text" name="title" placeholder="Название" value="<?= $product['title']; ?>" class="ainput">
                <input type="text" name="description" placeholder="Описание" value="<?= $product['description']; ?>" class="ainput">
                <select name="category_id" class="ainput">
                    <?php foreach ($categories as $cat): ?>
                        <option
                            value="<?= $cat['id']; ?>"
                            <? if($product['category_id'] == $cat['id']): ?> selected <? endif; ?>
                        >
                            <?= $cat['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="price" placeholder="Цена" value="<?= $product['price']; ?>" class="ainput">
                <input type="hidden" name="img_path" value="<?= $product['img_path']; ?>">
                <input type="hidden" name="id" value="<?= $product['id']; ?>">
                <input type="file" name="image">
                <input type="submit" value="Изменить" class="abtn">
            </div>
        </form>
    </div>
</div>

<?php include('app/components/Footer.php'); ?>

</body>
</html>