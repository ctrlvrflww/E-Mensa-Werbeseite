<?php
function bewertungenlast30() {
    $link = connectdb();

    $sql = "SELECT gericht.name, sterne_bewertung, bemerkung, benutzer.name, zeitpunkt, benutzer.id ,bewertung_id, hervorhebung FROM bewertung
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

    $sql = "SELECT gericht.name, sterne_bewertung, bemerkung, benutzer.name, zeitpunkt, benutzer.id, bewertung_id, hervorhebung FROM bewertung
            inner join gericht on gericht.id = bewertung.gericht_id
            inner join benutzer on benutzer.id = bewertung.benutzer_id
            WHERE benutzer_id = $userid ORDER BY zeitpunkt DESC LIMIT 30";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function deletebewertung($id)
{
    $link = connectdb();
    $sql = "DELETE FROM bewertung WHERE bewertung_id = $id";
    $result = mysqli_query($link, $sql);
    mysqli_close($link);
    return $result;
}

function highlight($id)
{
    $link = connectdb();
    $sql = "UPDATE bewertung SET hervorhebung = true WHERE bewertung_id = $id";
    $result = mysqli_query($link, $sql);
    mysqli_close($link);
    return $result;
}

function nohighlight($id)
{
    $link = connectdb();
    $sql = "UPDATE bewertung SET hervorhebung = false WHERE bewertung_id = $id";
    $result = mysqli_query($link, $sql);
    mysqli_close($link);
    return $result;
}