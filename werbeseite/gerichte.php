<!--
- Praktikum DBWT. Autoren:
- Anton, Schindler, 3621756
- Louis (Louisa), Rothmann, 3568758
- Team 301
-->
<?php

// Verbindungsdetails
$servername = "localhost";
$username = "root";
$password = "fifspkml0l343.";
$dbname = "emensawerbeseite";

// Verbindung herstellen
$verbindung = new mysqli($servername, $username, $password, $dbname);

// Verbindung prüfen
if ($verbindung->connect_error) {
    die("Verbindung fehlgeschlagen: " . $verbindung->connect_error);
}

// SQL Abfrage
$sql = "SELECT name,preisintern,preisextern FROM gericht";
// Speichere die Erebnisse aus der SQL Query in $result
$result = $verbindung->query($sql);

// Initialisiere neues leeres Array:
$gerichte = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { // fetch_assoc() wird verwendet, um Daten aus einem Ergebnis-Set einer SQL-Anfrage zu holen
        $gerichte[] = [
                "name" => $row["name"],
                "preisintern" => $row["preisintern"],
                "preisextern" => $row["preisextern"]
        ];
    }
} else {
    echo "Keine Ergebnisse gefunden";
}

$verbindung->close();




















?>