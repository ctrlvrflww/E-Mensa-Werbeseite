<?php

$file = fopen("./en", "r");

if (!$file) {
    die('Öffnen fehlgeschlagen');
}

if (isset($_GET['suche'])) {
    $suchwort = $_GET['suche'];
}
// Variable ob Wort gefunden wurde
$found = "false";

while (!feof($file)) {
    $line = fgets($file);
    // explode teilt string in array auf und trim löscht unnötige leerzeichen etc.
    $teile = explode (";", trim($line));

    if (count($teile) == 2 && $teile[0] == $suchwort) {
        echo $teile[1];
        $found = "true";
        break;
    }
}

if ($found == "false") {
    echo "Das gesuchte Wort ". $suchwort. " ist nicht enthalten.";
}

fclose($file);