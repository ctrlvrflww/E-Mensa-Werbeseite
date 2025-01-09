<?php

function insert_review($link,$sterne,$bemerkung){

    $string = $link->prepare("INSERT INTO bewertung(sterne_bewertung,bemerkung) VALUES(?,?)");
    $string->bind_param("ss",$sterne,$bemerkung);
    $string->execute();

    $string->close();
}