<?php
function db_loginVerify($email){
    $link = connectdb();

    $string = $link->prepare("SELECT * FROM benutzer WHERE email = (?)");
    $string->bind_param("s", $email);
    $string->execute();
    $string = $string->get_result();
    $pass = mysqli_fetch_all($string, MYSQLI_BOTH);
    $string->close();
    return $pass;
}

function incrementAnmeldung($email)
{
    $link = connectdb();
    $string = $link->prepare("CALL inkrementAnmeldung(?)");
    $string->bind_param("s", $email);
    $string->execute();
    $string->close();
    return $string;
}