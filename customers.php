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
    <h2>Customers</h2>
</div>

<div id="left">
    <?php echo "Klanten in de USA, Australie en Japan met een kredietlimiet van meer dan 100.000" . '<br><br>';
    $sql = "SELECT customerName, country, CONCAT('€', FORMAT(creditLimit,2, 'de_DE')) AS creditLimiet
            FROM customers
            WHERE (country = 'Australia' 
            OR country = 'USA' 
            OR country = 'Japan')
            AND creditLimit > '100000';";
    echo printTable($con, $sql) . '<br><br>'; ?>
</div>
<div id="right1">
    <?php echo "Overzicht van landen met meer dan 10 klanten in dat land" . '<br><br>';
    $sql = "SELECT country, COUNT(country) AS aantalCustomers
            FROM customers
            GROUP BY country
            HAVING COUNT(country) > 10;";
    echo printTable($con, $sql) . '<br><br>'; ?>
</div>
<div id="right2">
    <?php
    echo '<form method="post" action="customers.php">
          Zoek klanten met een beginletter:<br>
          <input type="text" name="filter">
          <input type="submit" value="filter">
          </form>';
    if (isset($_POST['filter'])) {
        $filter = $_POST['filter'];
        echo "Alle klanten beginnend met de letter: " . '<b>' . $filter . '</b><br>';
        $filter .= '%';

        $sql = "SELECT customerName, CONCAT(contactFirstName, ' ', contactLastName) AS contactFullName, phone
            FROM customers
            WHERE customerName LIKE '$filter';";

        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);
        echo "Het aantal klanten in deze selectie is: " . '<b>' . $rows . '</b><br><br>';

        echo printTable($con, $sql) . '<br><br>';
    }
    ?>
</div>
</body>
</html>