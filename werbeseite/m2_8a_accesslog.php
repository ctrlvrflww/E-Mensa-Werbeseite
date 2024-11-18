<!--
- Praktikum DBWT. Autoren:
- Anton, Schindler, 3621756
- Louis (Louisa), Rothmann, 3568758
- Team 301
-->
<?php

$file = fopen("./access_log.txt", "a");

if (!$file) {
    die('Öffnen fehlgeschlagen');
}

$line = $_SERVER['SERVER_NAME']." ".$_SERVER['REQUEST_TIME']." ".$_SERVER['HTTP_USER_AGENT']." \n";

fwrite($file, $line);

fclose($file);