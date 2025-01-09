<?php
function bewertungenlast30() {
    $link = connectdb();

    $sql = "SELECT gericht.name, sterne_bewertung, bemerkung, benutzer.name, zeitpunkt FROM bewertung
            inner join gericht on gericht.id = bewertung.gericht_id
            inner join benutzer on benutzer.id = bewertung.benutzer_id
            ORDER BY zeitpunkt DESC LIMIT 30";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function mybewertungenlast30($userid) {
    $link = connectdb();

    $sql = "SELECT gericht.name, sterne_bewertung, bemerkung, benutzer.name, zeitpunkt FROM bewertung
            inner join gericht on gericht.id = bewertung.gericht_id
            inner join benutzer on benutzer.id = bewertung.benutzer_id
            WHERE benutzer_id = $userid ORDER BY zeitpunkt DESC LIMIT 30";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}