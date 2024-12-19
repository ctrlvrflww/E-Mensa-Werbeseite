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
        $gerichte = db_gericht_select_above2();
        return view('main.inhalte', [
            'rd' => $rd,
            'gerichte' => $gerichte
        ]);
    }

    function anmeldung(RequestData $rd): string
    {
        return view('main.anmeldung', [
            'rd' => $rd
        ]);
    }

    function anmeldungVerifizieren(RequestData $rd): string
    {
        $email = $rd->getPostData()['email'];
        $passwort = $rd->getPostData()['passwort'];
        $salt = "emensa";
        $pass = db_loginVerify($email);
        if(isset($pass['email'])) {
            if (sha1($salt.$passwort) == $pass['passwort']) {
                return view('main.inhalte', [
                    'rd' => $rd
                ]);
            }
            else {
                $error = "Falsches Passwort";
                return view('main.anmeldung', [
                    'rd' => $rd,
                    'error' => $error
                ]);
            }
        }
        else {
            $error = "E-Mail Adresse ist nicht korrekt";
            return view('main.anmeldung', [
                'rd' => $rd,
                'error' => $error
            ]);
        }
    }
}