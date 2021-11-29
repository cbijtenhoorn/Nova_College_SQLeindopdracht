<?php
//bestand met databasegegevens
$conf["Username"]= 'root';
$conf["Password"]= '';
$conf["Host"]= 'localhost';
$conf["Database"]= 'classicmodels';

//verbind met server
$con = mysqli_connect($conf["Host"], $conf["Username"],
    $conf["Password"], $conf["Database"]);

// Verbinding is mislukt
if($con == false)
{
    echo "Kan geen verbinding maken met de database";
}

function printTable($con, $sql)                                 //functie om de opgegeven query in een tabel te zetten
{
    $result = mysqli_query($con, $sql);
    $colomns = mysqli_num_fields($result);

    $html = '<table>';
    for ($i = 0; $i < $colomns; $i++) {
        $finfo[$i] = mysqli_fetch_field_direct($result, $i);
    }

    $html .= '<thead><tr>';                                     //print de fieldnames
    for ($i = 0; $i < $colomns; $i++) {
        $html .= '<th>' . $finfo[$i]->name . '</th>';
    }

    $html .= '</tr></thead><tbody>';                            //print per rij de inhoud
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        foreach($row as $value) {
            $html .= '<td>' . $value . '</td>';
        }
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';
    return $html;                                               //returned de tabel om vervolgens te kunnen echo-en
}
?>