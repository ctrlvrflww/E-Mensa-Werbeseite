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
$password = "Tonihoni04!";
$dbname = "emensawerbeseite";

// Verbindung herstellen
$verbindung = new mysqli($servername, $username, $password, $dbname);

// Verbindung prüfen
if ($verbindung->connect_error) {
    die("Verbindung fehlgeschlagen: " . $verbindung->connect_error);
}

// Parameter für Sortierung aus URL holen
$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'name';
$direction = isset($_GET['direction']) ? $_GET['direction'] : 'asc';

// Sicherheitsmaßnahme gegen SQL Injection: Spezielle Werte definieren die erlaubt sind
$allowed_cols = ['name', 'preisintern', 'preisextern'];
$allowed_orderdirec = ['asc', 'desc'];

// Standard Fälle
if (!in_array($orderby, $allowed_cols)) { // ist der Wert aus $orderby in dem Array $allowed_cols?
    $orderby = 'name';
}

if (!in_array($direction, $allowed_orderdirec)) { // ist der Wert aus $direction, in dem Array $allowed_orderdirec?
    $direction = 'asc';
}

// SQL Abfrage für Name, Preis-Intern und Preis-Extern und Order
$sql = "SELECT DISTINCT ger.name,ger.preisintern,ger.preisextern,ger_all.code
        FROM gericht AS ger
        JOIN gericht_hat_allergen AS ger_all
        ON ger.id = ger_all.gericht_id
        ORDER BY " . $orderby . " " . $direction;
// Speichere die Erebnisse aus der SQL Query in $result
$result = $verbindung->query($sql);


// Initialisiere neues leeres Array:
$gerichte = array();


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { // fetch_assoc() wird verwendet, um Daten aus einem Ergebnis-Set einer SQL-Anfrage zu holen

        $gerichte[] = [
                "name" => $row["name"],
                "preisintern" => $row["preisintern"],
                "preisextern" => $row["preisextern"],
                "code" => $row["code"]
        ];
    }
} else {
    echo "Keine Ergebnisse gefunden";
}

// SQL Abfrage für Allergen-Liste
$sql_allergen = "SELECT name, code FROM allergen";
$result_all = $verbindung->query($sql_allergen);

$allergene = array();

if ($result_all->num_rows > 0) {
    while($row_all = $result_all->fetch_assoc()) { // fetch_assoc() wird verwendet, um Daten aus einem Ergebnis-Set einer SQL-Anfrage zu holen

        $allergene[] = [
            "name" => $row_all["name"],
            "code" => $row_all["code"]
        ];
    }
} else {
    echo "Keine Ergebnisse gefunden";
}

$verbindung->close();




















?>