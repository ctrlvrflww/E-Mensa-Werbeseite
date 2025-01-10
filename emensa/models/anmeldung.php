<?php
function db_loginVerify($link, $email): array
{

    $string = $link->prepare("SELECT * FROM benutzer WHERE email = (?)");
    $string->bind_param("s", $email);
    $string->execute();
    $string = $string->get_result();
    $pass = mysqli_fetch_all($string, MYSQLI_BOTH);

    $string->close();
    return $pass;
}

function incrementAnmeldung($link, $email)
{
    $string = $link->prepare("CALL inkrementAnmeldung(?)");
    $string->bind_param("s", $email);
    $string->execute();

    $string->close();
}

function updateTime($link, $email)
{
    $string = $link->prepare("UPDATE benutzer SET letzteanmeldung = NOW() WHERE email = ?");
    $string->bind_param("s", $email);
    $string->execute();

    $string->close();
}

function updateFail($link, $email)
{
    $string = $link->prepare("UPDATE benutzer SET letzterfehler = NOW() WHERE email = ?");
    $string->bind_param("s", $email);
    $string->execute();

    $string->close();
}
