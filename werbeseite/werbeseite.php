<!--
- Praktikum DBWT. Autoren:
- Anton, Schindler, 3621756
- Louis (Louisa), Rothmann, 3568758
- Team 301
-->
<?php
include('gerichte.php');

session_start();
$ip = $_SERVER['SERVER_NAME'];
$request_time = $_SERVER['REQUEST_TIME'];
$http_user_agent = $_SERVER['HTTP_USER_AGENT'];

$link=mysqli_connect("localhost",   // Host der Datenbank
    "root",                         // Benutzername zur Anmeldung
    "SWE24",                  // Passwort
    "emensawerbeseite"              // Auswahl der Datenbanken (bzw. des Schemas)
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$vorhanden = "SELECT COUNT(*) AS count FROM besuche WHERE http_user_agent = '$http_user_agent';";
//prüft, ob der user schon auf der Seite war
$result = mysqli_query($link, $vorhanden);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}
$bool = mysqli_fetch_assoc($result);
$cnt_calc = "SELECT COUNT(*) AS count_real FROM besuche;";
$resultat = mysqli_query($link, $cnt_calc);
if (!$resultat) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}
$cnt = mysqli_fetch_assoc($resultat);
$besuche_counter = $cnt['count_real'];
if($bool['count'] <= 0) {
    $einfügen = "INSERT INTO besuche (ip, request_time, http_user_agent) VALUE ('" . $ip . "','" . $request_time . "','" . $http_user_agent . "');";
    //fügt den User in die Datenbank ein
    $resultat1 = mysqli_query($link, $einfügen);
    if (!$resultat1) {
        echo "Fehler während der Abfrage:  ", mysqli_error($link);
        exit();
    }
}
mysqli_free_result($result);
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <style>
        * {
            font-family: Arial;
        }
        .grid-3 {
            grid-template-columns: 15% auto auto;
            display: grid;
            grid-gap: 20px;
        }
        .mitte {
            grid-column: 2;
        }
        a {
            padding: 10px;
            font-size: 20px;
            color: #33bec5;
        }
        #top {
            border: 2px solid black;
            text-align: center;
            padding: 15px;
        }
        header {
            padding-bottom: 10px;
            border-bottom: 2px solid black;
        }
        main {
            margin-top: 15px;
        }
        #Textblock {
            border: 2px solid black;
            padding: 5px;
        }
        table {
            border:2px solid black;
            /*color: darkgrey;*/
            border-collapse: collapse;

        }
        th{
            border:1px solid lightgray;
        }
        td{
            border:1px solid lightgray;
        }
        .tabellen_bilder{
            width: 200px;
            height:auto;
        }
        tr:nth-child(1) {
            border: 3px solid black;
        }
        .horizontal {
            padding: 0;
            list-style-type: none;
        }
        .horizontal > li {
            display: inline-block;
            padding: 5%;
        }
        form > .horizontal > li {
            display: inline-block;
            padding-left: 0;
            padding-top: 5px;
            padding-bottom: 0;
        }
        .end > .horizontal > li {
            display: inline-block;
            padding: 5px 0px 15px 20px;
            margin-right: 10px;
        }
        .end > .horizontal > li + li {
            border-left: 2px solid darkgrey;
        }
        #submit {
            position: relative;
            left: 70px;
        }
        #info {
            position: relative;
            left: 130px;
        }
        footer {
            border-top: 2px solid black;
            text-align: center;
        }
        #end {
            position: relative;
            left: 10%;
            right: 10%;
        }
        p {
            width: 70%;
        }
        #ankündigung {
            position: relative;
            left: 15%;
        }
        .red {
            color: red;
        }
    </style>
</head>
<body>
    <header class="grid-3">
        <div>
            <img src="logo-studentenwerk.png" alt="E-Mensa Logo" width="100">
        </div>
        <div id="top">
            <a href="#ankündigung"> Ankündigung</a>
            <a href="#speisen"> Speisen</a>
            <a href="#zahlen">Zahlen</a>
            <a href="#kontakt">Kontakt</a>
            <a href="#infos">Wichtige für Uns</a>
        </div>
    </header>
    <main class="grid-3">
        <div class="mitte" id="ankündigung">
            <img src="Lasagne.jpg" alt="Bild" width="450">
        </div>
        <div class="mitte">
            <h2>Bald gibt es Essen auch online ;)</h2>
            <p id="Textblock">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
            </p>
        </div>
        <div class="mitte" id="speisen">
            <h2>Köstlichkeiten, die Sie erwarten</h2>
            <!--<p>aktuelle Sortierung:</p> <?php echo "order:". $orderby . " Reihenfolge: " . $direction?> -->
            <table>
                <tr><th>Name</th><th>Preis intern</th><th>Preis extern</th><th>Allergene</th></tr>
                <?php foreach ($gerichte as $gericht): ?>
                <tr><td><?php echo $gericht['name']?></td><td><?php echo $gericht['preisintern'] . "€"?></td><td><?php echo $gericht['preisextern'] . "€"?></td><td> <?php echo $gericht['code'] ?></td></tr>
                <?php endforeach;?>
            </table>


            <h3>Liste mit Allergenen</h3>
            <table>
                <tr><th>Name</th><th>Code</th></tr>
                <?php foreach ($allergene as $allergen): ?>
                <tr><td><?php echo $allergen['name']?></td><td><?php echo $allergen['code'] ?></td></tr>
                <?php endforeach;?>
            </table>
            <br>
            <a href="wunschgericht.php" >Teilen sie ihr Wunschgericht mit uns</a>
        </div>
        <div class="mitte" id="zahlen">
            <h2>E-Mensa in Zahlen</h2>
            <ul class="horizontal">
                <li><?php echo $besuche_counter?> Besuche</li>
                <li><?php
                    $link = mysqli_connect("localhost",   // Host der Datenbank
                        "root",                         // Benutzername zur Anmeldung
                        "SWE24",                  // Passwort
                        "emensawerbeseite"              // Auswahl der Datenbanken (bzw. des Schemas)
                    );

                    if (!$link) {
                        echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
                        exit();
                    }
                    $anmeldungen = "SELECT COUNT(*) AS count FROM newsletter_anmeldungen;";
                    // zählt die Anzahl der Anmeldungen in der Datenbank
                    $result = mysqli_query($link, $anmeldungen);
                    if (!$result) {
                        echo "Fehler während der Abfrage:  ", mysqli_error($link);
                        exit();
                    }
                    $mails = mysqli_fetch_assoc($result);
                    $meals = "SELECT COUNT(*) AS zaehler FROM gericht;";
                    //zählt die Anzahl der Gerichte in der Datenbank
                    $ergebnis = mysqli_query($link, $meals);
                    if (!$ergebnis) {
                        echo "Fehler während der Abfrage:  ", mysqli_error($link);
                        exit();
                    }
                    $essen = mysqli_fetch_assoc($ergebnis);
                    echo $mails['count']. " Anmeldungen zum Newsletter</li><li>". $essen['zaehler'];
                    mysqli_free_result($result);
                    mysqli_free_result($ergebnis);
                    mysqli_close($link);
                    ?> Speisen</li>
            </ul>
        </div>
        <div class="mitte" id="kontakt">
            <h2>Interesse geweckt? Wir informieren Sie!</h2>
            <form method="post" action="werbeseite.php#kontakt">
                <ul class="horizontal">
                    <li>
                        <label for="vorname">Ihr Name:</label>
                        <br>
                        <input type="text" id="vorname" name="vorname" placeholder= "<?php
                        if (isset($_POST['vorname']))
                        {
                            echo trim($_POST['vorname'], " ");
                            //leerzeichen vor und hinter dem Namen entfernen
                        }
                        else {echo "Vorname";}
                        ?>" required>
                    </li>
                    <li>
                        <label for="mail">Ihre E-Mail:</label>
                        <br>
                        <input type="text" id="mail" name="mail-adresse" placeholder="<?php
                        if (isset($_POST['mail-adresse']))
                        {
                            echo trim($_POST['mail-adresse'], " ");
                            //leerzeichen vor und hinter der Email entfernen
                        }
                        else {echo "E-Mail";}
                        ?>" required>
                    </li>
                    <li>
                        <label for="sprache">Newsletter bitte in:</label>
                        <br>
                        <select id="sprache" name="sprache">
                            <option value="GER">Deutsch</option>
                            <option value="EN">English</option>
                            <option value="ES">Spanish</option>
                        </select>
                    </li>
                </ul>
                <input type="checkbox" required> Den Datenschutzbestimmungen stimme ich zu
                <input type="submit" id="submit" value="Zum Newsletter anmelden">
            </form>
            <?php
            if (isset($_POST['vorname'])) {
                $name = trim($_POST['vorname'], " ");
                $mail = trim($_POST['mail-adresse'], " ");
                $at = '@';
                $point = '.';
                $position = strpos($mail, $at); //position des @
                $offset = substr($mail,$position); //position nach dem @
                $position_point = strpos($offset, $point); //position des Punktes in dem Teil nach dem @
                $sprache = $_POST['sprache'];
                if ($name == "" || $name == ' ')
                {
                    echo "<p class='red'>Bitte geben Sie ihren richtigen Namen ein</p>";
                }
                elseif ($mail == "" || $position == '0' || $position == strlen($mail) || $position_point == '1' || $position_point == strlen($offset) - 1 || str_contains($mail, ' '))
                    // prüft, ob vor und nach dem @ text steht und ob danach ein punkt kommt, nachdem wieder Text kommt
                {
                    echo "<p class='red'>Bitte geben Sie eine gültige Mail-Adresse ein</p>";
                }
                else {
                    $link = mysqli_connect("localhost",   // Host der Datenbank
                        "root",                         // Benutzername zur Anmeldung
                        "SWE24",                  // Passwort
                        "emensawerbeseite"              // Auswahl der Datenbanken (bzw. des Schemas)
                    );

                    if (!$link) {
                        echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
                        exit();
                    }
                    $dopplung = "SELECT COUNT(*) AS count FROM newsletter_anmeldungen WHERE mail = '$mail';";
                    //prüft, ob die Mail bereits angemeldet ist
                    $result = mysqli_query($link, $dopplung);
                    if (!$result) {
                        echo "Fehler während der Abfrage:  ", mysqli_error($link);
                        exit();
                    }
                    $bool = mysqli_fetch_assoc($result);
                    if($bool['count'] <= 0)
                    {
                        //fügt den Namen, Mail und Sprache in die Datenbank ein
                        $anmeldung_query = "INSERT INTO newsletter_anmeldungen (name, mail, sprache) VALUE (?,?,?);";
                        $anmeldung = mysqli_stmt_init($link);
                        mysqli_stmt_prepare($anmeldung, $anmeldung_query);
                        mysqli_stmt_bind_param($anmeldung, "sss", $name, $mail, $sprache);
                        if(mysqli_stmt_execute($anmeldung)){
                            echo "<br> Ihre Daten wurden gespeichert :) <br>";
                        } else {
                            echo "Fehler beim Einfügen: ", mysqli_stmt_error($anmeldung);
                            exit();
                        }

                        mysqli_stmt_close($anmeldung);
                    }
                    else {echo "<br> <p class='red'> Die von ihnen eingegebener Mail-Adresse ist schon angemeldet. </p>";}
                    mysqli_free_result($result);
                    mysqli_close($link);
                }
            }
            ?>
        </div>
        <div class="mitte" id="infos">
            <h2>Das ist uns wichtig</h2>
            <ul id="info">
                <li>Beste frische saisonale Zutaten</li>
                <li>Ausgewogene abwechslungsreiche Gerichte</li>
                <li>Sauberkeit</li>
            </ul>
        </div>
        <div id="end" class="mitte">
            <h2 >Wir freuen uns auf Ihren Besuch!</h2>
        </div>
    </main>
    <footer class="grid-3">
        <div class="mitte">
            <ul class="horizontal">
                <li>(c) E-mensa GmbH</li>
                <li> Ihr Name hier</li>
                <li><a href="Lasagne.jpg">Impressum</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>