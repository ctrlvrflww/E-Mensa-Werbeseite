<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichte_m4_7c.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        logger()->info('Zugriff Hauptseite');
        return view('home', ['rd' => $request ]);
    }
    
    public function debug(RequestData $request) {
        return view('debug');
    }

    function main(RequestData $rd) {
        $gerichte = db_gericht_select_above2();
        return view('main.inhalte', [
            'rd' => $rd,
            'gerichte' => $gerichte
        ]);
    }

    function anmeldung(RequestData $rd) {
        return view('main.anmeldung', [
            'rd' => $rd
        ]);
    }
}