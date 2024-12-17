<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_above2() {
    $link = connectdb();

    $sql = 'SELECT bildname, name, preisintern, preisextern FROM gericht WHERE preisintern > 2 ORDER BY name DESC';
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}