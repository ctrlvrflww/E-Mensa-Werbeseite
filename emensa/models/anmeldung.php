<?php
function db_loginVerify($email): array
{
    $link = connectdb();
    mysqli_begin_transaction($link);

    $string = $link->prepare("SELECT * FROM benutzer WHERE email = (?)");
    $string->bind_param("s", $email);
    $string->execute();
    $string = $string->get_result();
    $pass = mysqli_fetch_all($string, MYSQLI_BOTH);

    mysqli_commit($link);
    $string->close();

    return $pass;
}

function incrementAnmeldung($email)
{
    $link = connectdb();
    mysqli_begin_transaction($link);

    $string = $link->prepare("CALL inkrementAnmeldung(?)");
    $string->bind_param("s", $email);
    $string->execute();

    mysqli_commit($link);
    $string->close();
}

function updateTime($email){
    $link = connectdb();
    mysqli_begin_transaction($link);

    $string = $link->prepare("UPDATE benutzer SET letzteanmeldung = NOW() WHERE email = ?");
    $string->bind_param("s", $email);
    $string->execute();

    mysqli_commit($link);
    $string->close();
}

function updateFail($email){
    $link = connectdb();
    mysqli_begin_transaction($link);

    $string = $link->prepare("UPDATE benutzer SET letzterfehler = NOW() WHERE email = ?");
    $string->bind_param("s", $email);
    $string->execute();

    mysqli_commit($link);
    $string->close();
}