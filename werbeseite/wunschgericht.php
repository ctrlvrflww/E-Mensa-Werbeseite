<!--
- Praktikum DBWT. Autoren:
- Anton, Schindler, 3621756
- Louis (Louisa), Rothmann, 3568758
- Team 301
-->

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihr Wunschgericht</title>
    <style>
        * {
            font-family: Arial;
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
        .red {
            color: red;
        }
        p {
            color: grey;
            font-size: 14px;
        }
    </style>
</head>
<main>
<h2>Haben sie ein Wunschgericht?</h2>
<form method="post">
    <label for="wunschgerichtname">Name des Wunschgerichts:</label>
    <br>
    <input type="text" id="wunschgerichtname" name="wunschgerichtname" size="25" placeholder="<?php
    if (isset($_POST['wunschgerichtname']))
    {
        echo trim($_POST['wunschgerichtname'], " ");
        //leerzeichen vor und hinter dem Namen entfernen
    }
    else {echo "Name des Gerichts";}
    ?>" required>
    <br> <br>
    <label for="beschreibung">Beschreibung des Gerichtes:</label>
    <br>
    <textarea id="beschreibung" name="beschreibung" rows="6" cols="80" placeholder="<?php
    if (isset($_POST['beschreibung']))
    {
        echo trim($_POST['beschreibung'], " ");
        //leerzeichen vor und hinter dem Namen entfernen
    }
    else {echo "Beschreibung des Gerichtes und der Zubereitung";}
    ?>" required></textarea>
    <ul class="horizontal">
        <li>
            <label for="name">Ihr Name:</label>
            <br>
            <input type="text" id="name" name="name" placeholder= "<?php
            if (isset($_POST['name']))
            {
                echo trim($_POST['name'], " ");
                //leerzeichen vor und hinter dem Namen entfernen
            }
            else {echo "Name";}
            ?>">
        </li>
        <li>
            <label for="mail-adresse">Ihre E-Mail:</label>
            <br>
            <input type="text" id="mail-adresse" name="mail-adresse" placeholder="<?php
            if (isset($_POST['mail-adresse']))
            {
                echo trim($_POST['mail-adresse'], " ");
                //leerzeichen vor und hinter der Email entfernen
            }
            else {echo "E-Mail";}
            ?>" required>
        </li>
        <li>
            <input type="submit" id="submit" value="Wunsch abschicken">
        </li>
    </ul>
</form>
    <p>Sie werden als anonym gespeichert, falls sie keinen Namen angeben</p>
<?php
if (isset($_POST['name'])) {
    $gerichtname = $_POST['wunschgerichtname'];
    $beschreibung = $_POST['beschreibung'];
    $name = $_POST['name'];
    $mail = strval($_POST['mail-adresse']);
    $date = date("Y-m-d");
    $at = '@';
    $point = '.';
    $position = strpos($mail, $at); //position des @
    $offset = substr($mail, $position); //position nach dem @
    $position_point = strpos($offset, $point); //position des Punktes in dem Teil nach dem @
    if ($name == "" || $name == " ") {
        $name = "anonym";
    }
    if ($mail == "" || $position == '0' || $position == strlen($mail) || $position_point == '1' || $position_point == strlen($offset) - 1 || str_contains($mail, ' ')) // prüft, ob vor und nach dem @ text steht und ob danach ein punkt kommt, nachdem wieder Text kommt
    {
        echo "<p class='red'>Bitte geben Sie eine gültige Mail-Adresse ein</p>";
    }
    else {
            $link = new mysqli("localhost", "root", "Tonihoni04!", "emensawerbeseite");

            $wunschgericht = $link->prepare("INSERT INTO wunschgerichte (name, beschreibung, datum) VALUE (?, ?, ?);");
            $wunschgericht->bind_param("sss", $gerichtname, $beschreibung, $date);
            $wunschgericht->execute();

            $dopplung = "SELECT COUNT(*) AS count FROM erstellerin WHERE email = '$mail';";
            //prüft, ob die Mail bereits angemeldet ist
            $result = mysqli_query($link, $dopplung);
            if (!$result) {
                echo "Fehler während der Abfrage:  ", mysqli_error($link);
                exit();
            }
            $bool = mysqli_fetch_assoc($result);
            if($bool['count'] <= 0) {
                $erstellerin = $link->prepare("INSERT INTO erstellerin(name, email) values (?, ?)");
                $erstellerin->bind_param("ss", $name, $mail);
                $erstellerin->execute();
                $erstellerin->close();
            }


            $nummer = "SELECT LAST_INSERT_ID () FROM wunschgerichte";
            $resultint = mysqli_query($link, $nummer);
            $row = mysqli_fetch_array($resultint);
            $nummer = $row[0];

            $erstellerin_wunsch = $link->prepare("INSERT INTO erstellerin_hat_wunschgerichte (wunschgerichtnummer, erstellerin_email) value (?, ?)");
            $erstellerin_wunsch->bind_param("is", $nummer, $mail);
            $erstellerin_wunsch->execute();

            $wunschgericht->close();
            $erstellerin_wunsch->close();

            echo "<br>Ihre Daten wurden gespeichert :) <br>";
    }
}
?>
    <br>
    <a href="werbeseite.php">Zurück zur Hauptseite</a>
</main>
