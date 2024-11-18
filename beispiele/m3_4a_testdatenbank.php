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

$sql = "SELECT * FROM gericht;";

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}

$gerichtart = "";
echo "<table border= '1'>";
echo "<tr><th>ID</th><th>Name</th><th>Beschreibung</th><th>Erfasst am</th><th>Gerichtart</th><th>Preis Intern</th><th>Preis Extern</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    if($row['vegan']) {$gerichtart = "vegan";} else if($row['vegetarisch']) {$gerichtart = "vegetarisch";} else {$gerichtart = "Klassiker";}
    echo '<tr> <td>'.$row['id'].'</td><td>'.$row['name'].'</td><td>'.$row['beschreibung'].'</td><td>'.$row['erfasst_am'].'</td><td>'.$gerichtart.'</td><td>'.$row['preisintern'].'</td><td>'.$row['preisextern'].'</td></tr>';
}
echo "</table>";

mysqli_free_result($result);
mysqli_close($link);