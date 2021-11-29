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
    <h2>Sales</h2>
</div>

<div id="left">
    <?php echo "Overzicht van het aantal orders per status en per jaar, voor de jaren 2004 en 2005, uit de tabel orders." . '<br><br>';
    $sql = "SELECT YEAR(orderDate) AS jaar, status, COUNT(orderDate) AS aantal  
            FROM orders 
            WHERE orderDate BETWEEN '2004/01/01' AND '2005/12/31' 
            GROUP BY YEAR(orderDate), status 
            ORDER BY YEAR(orderDate) DESC;";
    echo printTable($con, $sql) . '<br><br>'; ?>
</div>
<div id="right1">
    <?php echo "Overzicht van het totaal van alle ontvangen betalingen per jaar, uit de tabel payments." . '<br><br>';
    $sql = "SELECT YEAR(paymentDate) AS jaar, COUNT(paymentDate) AS aantalBetalingen, CONCAT('€', FORMAT(SUM(amount), 'de_DE')) AS totaalBetalingen
            FROM payments
            GROUP BY YEAR(paymentDate)
            ORDER BY YEAR(paymentDate) DESC;";
    echo printTable($con, $sql) . '<br><br>'; ?>
</div>
<div id="right2">
    <?php echo "Overzicht van de orders met een orderdatum in 2005, met de status shipped en waarbij het veld comments gevuld is." . '<br><br>';
    $sql = "SELECT orderNumber, DATE_FORMAT(orderDate,'%d %b %y') AS orderdatum, status, comments
            FROM orders
            WHERE YEAR(orderDate) = '2005'
            AND status = 'Shipped'
            AND comments != 'NULL'
            ORDER BY orderDate ASC;";
    echo printTable($con, $sql) . '<br><br>'; ?>
</div>
</body>
</html>