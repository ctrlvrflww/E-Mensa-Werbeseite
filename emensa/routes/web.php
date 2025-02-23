<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

return array(
    '/'             => "HomeController@main",
    '/anmeldung'    => "HomeController@anmeldung",
    '/abmeldung'    => "HomeController@abmeldung",
    '/bewertung'    => "HomeController@bewertung",
    '/bewertungen'  => "HomeController@bewertungen",
    '/meinebewertungen' => "HomeController@meinebewertungen",
    '/deletebewertung'    => "HomeController@deletebewertung",
    '/highlight'    => "HomeController@highlight",
    '/nohighlight'    => "HomeController@nohighlight",
    '/bewertung-speichern'  => "HomeController@bewertung_speichern",
    '/anmeldung-verifizieren' => "HomeController@anmeldungVerifizieren",
    "/demo"         => "DemoController@demo",
    '/dbconnect'    => 'DemoController@dbconnect',
    '/debug'        => 'HomeController@debug',
    '/error'        => 'DemoController@error',
    '/requestdata'   => 'DemoController@requestdata',

    // Erstes Beispiel:
    '/m4_7a_queryparameter' => 'ExampleController@m4_7a_queryparameter',
    '/m4_7b_kategorie' => 'ExampleController@m4_7b_kategorie',
    '/m4_7c_gerichte' => 'ExampleController@m4_7c_gerichte',
    '/m4_7d_layout' => 'LayoutController@m4_7d_layout',
    '/m4' => 'ExampleController@m4_7a_queryparameter',

);