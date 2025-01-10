<?php

function insert_review($link,$sterne,$bemerkung,$gericht_id){

    $string = $link->prepare("INSERT INTO bewertung(sterne_bewertung,bemerkung,gericht_id) VALUES(?,?,?)");
    $string->bind_param("ssi",$sterne,$bemerkung,$gericht_id);
    $string->execute();

    $string->close();
}