<?php
include('app/services/Base.php');

$products = $database->query("SELECT * FROM `cart` LEFT JOIN `products` ON `cart`.`product_id` = `products`.`id`")->fetchAll(2);
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
        <div class="adminpanel-content">
            <h2>Подтвердите заказ</h2>
            <form action="/app/actions/Order/create.php" method="post">
                <input type="password" name="password" class="ainput" placeholder="Введите пароль">
                <button type="submit">Подтвердить</button>
            </form>
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
