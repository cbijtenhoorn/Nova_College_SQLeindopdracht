<?php include 'configdb.php'; ?>

<html lang="en">
<head>
    <title>E i n d o p d r a c h t</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="header">
    <a href="sales.php">Sales</a>
    <a href="customers.php">Customers</a>
    <a href="products.php">Product Catalogus</a>
    <h2>Product Catalogus</h2>
</div>

<div id="left">
    <?php echo "Overzicht van aantallen en totale voorraadwaarde per productLine" . '<br><br>';
    $sql = "SELECT productLine, COUNT(productLine) AS aantalProducten, CONCAT('€', FORMAT(SUM((quantityInStock*buyPrice)), 'de_DE')) AS waardeVoorraad
            FROM products
            GROUP BY productLine;";
    echo printTable($con, $sql) . '<br><br>'; ?>
</div>
<div id="right1">
    <?php echo "";
    echo printTable($con, $sql) . '<br><br>'; ?>
</div>
</body>
</html>