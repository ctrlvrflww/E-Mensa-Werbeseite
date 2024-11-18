<?php
$link=mysqli_connect("localhost",   // Host der Datenbank
    "root",                         // Benutzername zur Anmeldung
    "Tonihoni04!",                  // Passwort
    "emensawerbeseite"              // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql = "SELECT id, name, beschreibung FROM gericht";

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}

echo "<table>";
echo "<th>"."</th>";
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>'.$row['id']. ':'. $row['name']. '</tr>';
}
echo "</table>";

mysqli_free_result($result);
mysqli_close($link);