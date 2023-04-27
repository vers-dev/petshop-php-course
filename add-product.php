<?php
include('app/services/Base.php');
if (!auth()){
    redirect('');
}
$categories = $database->query("SELECT * FROM `categories`")->fetchAll(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('app/components/MetaTags.php'); ?>

    <title>Добавить товар</title>
</head>
<body>

    <?php include('app/components/Header.php'); ?>

    <div class="auth">
        <div class="container">
            <p class="title">Добавить товар</p>
            <form action="app/actions/Product/create.php" method="post" name="addProduct" enctype="multipart/form-data">
                <div class="auth-items">
                    <input type="text" name="title" placeholder="Название" class="ainput">
                    <input type="text" name="description" placeholder="Описание" class="ainput">
                    <select name="category_id" class="ainput">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="price" placeholder="Цена"  class="ainput">
                    <input type="file" name="image">
                    <input type="submit" value="Добавить"  class="abtn">
                </div>
            </form>
        </div>
    </div>

    <?php include('app/components/Footer.php'); ?>
</body>
</html>