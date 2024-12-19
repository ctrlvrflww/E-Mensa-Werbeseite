<?php
function db_loginVerify(RequestData $rd){
    $email = $rd->getPostData()['email'];
    $passwort = $rd->getPostData()['passwort'];
    $salt = "emensa";
    $link = connectdb();

    $string = $link->prepare("SELECT * FROM benutzer WHERE email = (?)");
    $string->bind_param("s", $email);
    $string->execute();
    $pass = mysqli_query($link, $string);
    $string->close();
    return $pass;
}
