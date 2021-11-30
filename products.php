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
    <?php
    $sql = "SELECT productLine FROM productlines;";
    $result = mysqli_query($con, $sql);

    echo '<form method="post" action="products.php">
          <select name="productline">';
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $value) {
            if(isset($_POST['productline']) && $_POST['productline'] == $value){
                echo '<option selected>' . $value . '</option>';
            }
            else {
                echo '<option>' . $value . '</option>';
            }
        }
    }
    echo '</select><input type="submit" value="filter"></form>';

    if (isset($_POST['productline'])) {
        $filter = $_POST['productline'];
        $sql = "SELECT productCode, productName, CONCAT('€', FORMAT(buyPrice, 2, 'de_DE')) AS price
                FROM products
                WHERE productLine = '$filter';";

        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);

        echo "De geselecteerde productlijn is: " . '<b>' . $filter . '</b><br>';
        echo "Totaal aantal producten in deze productlijn is: " . '<b>' . $rows . '</b><br><br>';
        echo printTable($con, $sql) . '<br><br>';
    }
    ?>
</div>
</body>
</html>