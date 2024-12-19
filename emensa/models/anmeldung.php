<?php
function db_loginVerify($email){
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

    return $string;
}