<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichte_m4_7c.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/../models/anmeldung.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request): string
    {
        logger()->info('Zugriff Hauptseite');
        return view('home', ['rd' => $request ]);
    }
    
    public function debug(RequestData $request): string
    {
        return view('debug');
    }

    function main(RequestData $rd): string
    {
        $name = "Nicht angemeldet";
        if(isset($_SESSION['name'])) {$name = $_SESSION['name'];}
        $gerichte = db_gericht_select_above2();
        return view('main.inhalte', [
            'rd' => $rd,
            'gerichte' => $gerichte,
            'name' => $name
        ]);
    }

    function anmeldung(RequestData $rd): string
    {
        return view('main.anmeldung', [
            'rd' => $rd
        ]);
    }

    function abmeldung(RequestData $rd): string
    {
        if (isset($_SESSION['name'])) {unset($_SESSION['name']);}
        header('Location: /');
        logger()->info("Erfolgreiche Abmeldung");
        exit();
    }

    function anmeldungVerifizieren(RequestData $rd): string
    {
        $email = $rd->getPostData()['email'];
        $passwort = $rd->getPostData()['passwort'];
        $salt = "emensa";
        $pass = db_loginVerify($email);
        if(isset($pass [0] ['email'])) {
            if (sha1($salt.$passwort) == $pass [0]['passwort']) {
                logger()->info("Erfolgreiche Anmeldung");
                incrementAnmeldung($pass[0]['email']);
                updateTime($pass[0]['email']);
                $_SESSION['name'] = $pass[0]['name'];
                header('Location: /');
                exit();
            }
            else {
                updateFail($pass[0]['email']);
                $error = "Falsches Passwort";
                logger()->warning("Fehlgeschlagene Anmeldung (Passwort)");
                return view('main.anmeldung', [
                    'rd' => $rd,
                    'error' => $error
                ]);
            }
        }
        else {
            updateFail($pass[0]['email']);
            $error = "E-Mail Adresse ist nicht korrekt";
            logger()->warning("Fehlgeschlagene Anmeldung (E-Mail)");
            return view('main.anmeldung', [
                'rd' => $rd,
                'error' => $error
            ]);
        }
    }
}