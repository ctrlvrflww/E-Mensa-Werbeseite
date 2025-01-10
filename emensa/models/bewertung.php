<?php

function insert_review($link,$sterne,$bemerkung,$gericht_id){

    $string = $link->prepare("INSERT INTO bewertung(sterne_bewertung,bemerkung,gericht_id) VALUES(?,?,?)");
    $string->bind_param("ssi",$sterne,$bemerkung,$gericht_id);
    $string->execute();

    $string->close();
}

function get_gericht($link, $gericht_id){

    $string = $link->prepare("SELECT name, bildname FROM gericht WHERE id = ?");
    $string->bind_param("i", $gericht_id);
    $string->execute();

    $result = $string->get_result();

    return $result;
}