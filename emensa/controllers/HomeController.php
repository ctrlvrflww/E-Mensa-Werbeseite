<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichte_m4_7c.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/../models/anmeldung.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/../models/bewertungen.php');

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
        $bewertungen = bewertungenlast30();
        return view('main.inhalte', [
            'rd' => $rd,
            'gerichte' => $gerichte,
            'name' => $name,
            'bewertungen' => $bewertungen
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
        if (isset($_SESSION['id'])) {unset($_SESSION['id']);}
        if (isset($_SESSION['admin'])) {unset($_SESSION['admin']);}
        header('Location: /');
        logger()->info("Erfolgreiche Abmeldung");
        exit();
    }

    /**
     * @throws Exception
     */
    function anmeldungVerifizieren(RequestData $rd): string
    {
        $email = $rd->getPostData()['email'];
        $passwort = $rd->getPostData()['passwort'];
        $salt = "emensa";

        $link = connectdb();
        mysqli_begin_transaction($link);

        $pass = db_loginVerify($link,$email);

        try {
            if(isset($pass [0] ['email'])) {
                if (sha1($salt.$passwort) == $pass [0]['passwort']) {
                    //logger()->info("Erfolgreiche Anmeldung");
                    incrementAnmeldung($link,$pass[0]['email']);
                    updateTime($link, $pass[0]['email']);
                    $_SESSION['name'] = $pass[0]['name'];
                    $_SESSION['id'] = $pass[0]['id'];
                    $_SESSION['admin'] = $pass[0]['admin'];
                    mysqli_commit($link);
                    header('Location: /');
                    exit();
                }
                else {
                    updateFail($link, $pass[0]['email']);
                    $error = "Falsches Passwort";
                    //logger()->warning("Fehlgeschlagene Anmeldung (Passwort)");
                    mysqli_commit($link);
                    return view('main.anmeldung', [
                        'rd' => $rd,
                        'error' => $error
                    ]);
                }
            }
            else {
                $error = "E-Mail Adresse ist nicht korrekt";
                //logger()->warning("Fehlgeschlagene Anmeldung (E-Mail)");
                mysqli_commit($link);
                return view('main.anmeldung', [
                    'rd' => $rd,
                    'error' => $error
                ]);
            }
        } catch (Exception $e) {
            mysqli_rollback($link);
            throw $e;
        } finally {
            $error = "Anmeldung fehlgeschlagen";
            mysqli_close($link);
            return view('main.anmeldung', [
                'rd' => $rd,
                'error' => $error
            ]);
        }
    }

    function bewertung(){


    }

    function bewertungen()
    {
        $bewertungen = bewertungenlast30();
        return view('main.bewertungen', [
            'bewertungen' => $bewertungen
        ]);
    }
    function meinebewertungen()
    {
        $userid = $_SESSION['id'];
        $bewertungen = mybewertungenlast30($userid);
        return view('main.bewertungen', [
            'bewertungen' => $bewertungen
        ]);
    }

    function deletebewertung(RequestData $rd)
    {
        $bewertung_id = $rd->getPostData()['data'];
        deletebewertung($bewertung_id);
        header("Location: /bewertungen");
    }

    function highlight(RequestData $rd)
    {
        $bewertung_id = $rd->getPostData()['highlight'];
        highlight($bewertung_id);
        header("Location: /bewertungen");
    }
    function nohighlight(RequestData $rd)
    {
        $bewertung_id = $rd->getPostData()['highlight'];
        nohighlight($bewertung_id);
        header("Location: /bewertungen");
    }
}