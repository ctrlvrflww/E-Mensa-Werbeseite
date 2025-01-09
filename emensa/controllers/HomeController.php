<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichte_m4_7c.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/../models/anmeldung.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/../models/bewertung.php');

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
                    mysqli_commit($link);

                    if(isset($_SESSION['redirect_after_login'])) {
                        $redirect = $_SESSION['redirect_after_login'];
                        unset($_SESSION['redirect_after_login']);
                        header("Location: /$redirect");
                    } else {
                        header('Location: /');
                    }

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
        if(!isset($_SESSION['name'])) {
            $_SESSION['redirect_after_login'] = 'bewertung';
            return view('main.anmeldung');
            exit;
        } else {
            return view('main.bewertung');
        }

    }

    function bewertung_speichern(RequestData $rd){
        $sterne = $rd->getPostData()['Sterne'];
        $bemerkung = $rd->getPostData()['bemerkung'];

        $link = connectdb();
        insert_review($link,$sterne,$bemerkung);
        header('Location: /');
    }
}