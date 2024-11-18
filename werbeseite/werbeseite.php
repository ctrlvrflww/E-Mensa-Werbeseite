<!--
- Praktikum DBWT. Autoren:
- Anton, Schindler, 3621756
- Louis (Louisa), Rothmann, 3568758
- Team 301
-->
<?php
include('gerichte.php');
include('m2_8a_accesslog.php');

session_start();
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0; // Initialisiere den Zähler
}
    $_SESSION['counter']++;
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

            <table>
                <tr><th>Name</th><th>Preis intern</th><th>Preis extern</th><th>Bild</th></tr>
                <?php $gerichte_counter = 0; foreach ($gerichte as $gericht): $gerichte_counter++?>
                <tr><td><?php echo $gericht['name']?></td><td><?php echo $gericht['preis_intern']?></td><td><?php echo $gericht['preis_extern']?></td><td><img class="tabellen_bilder" src="<?php echo $gericht['bild']?>" alt="Bild von Essen"></td></tr>
                <?php endforeach;?>
            </table>

            <!--
            <table>
                <tr><th></th><th>Preis intern</th><th>Preis extern</th></tr>
                <tr><td>Rindfleisch mit Bambus, Kaiserschoten und rotem Paprika, dazu Mie Nudeln</td><td>3,50</td><td>6,20</td></tr>
                <tr><td>Spinatrisotto mit kleinen Samosateigecken und gemischter Salat</td><td>2,90</td><td>5,30</td></tr>
                <tr><td>...</td><td>...</td><td>...</td></tr>
            </table>
            -->
        </div>
        <div class="mitte" id="zahlen">
            <h2>E-Mensa in Zahlen</h2>
            <ul class="horizontal">
                <li><?php echo $_SESSION['counter']?> Besuche</li>
                <li><?php
                    $file = fopen('./userdata.txt', 'r');
                    if (!$file) {
                        die('Öffnen von userdata.txt fehlgeschlagen');
                    }

                    $counter = 0;

                    while (!feof($file)) {
                        fgets($file, 1024);
                        $counter++;
                    }
                    echo $counter;
                    fclose($file);
                    ?> Anmeldungen zum Newsletter</li>
                <li><?php echo $gerichte_counter ?> Speisen</li>
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
                $position = strpos($mail, $at);
                $offset = substr($mail,$position);
                $position_point = strpos($offset, $point);
                $sprache = $_POST['sprache'];
                if ($name == "" || str_contains($name, ' '))
                {
                    echo "<p class='red'>Bitte geben Sie ihren richtigen Namen ein</p>";
                }
                elseif ($mail == "" || $position == '0' || $position == strlen($mail) || $position_point == '1' || $position_point == strlen($offset) - 1 || str_contains($mail, ' '))
                {
                    echo "<p class='red'>Bitte geben Sie eine gültige Mail-Adresse ein</p>";
                }
                else {
                    $file = fopen("./userdata.txt", "a");

                    if (!$file) {
                        die('Öffnen fehlgeschlagen');
                    }

                    $line = $name . " " . $mail. " " . $_POST['sprache'] . " \n";

                    fwrite($file, $line);

                    fclose($file);
                    echo "<br> Ihre Daten wurden gespeichert :) <br>";
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