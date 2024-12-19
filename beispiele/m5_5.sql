    /* Um Konflikte im Procedure zu vermeiden verwendet man Delimiter:
       Wenn man Semikolon innerhalb des Procedures verwendet, kann es zu Konflikten kommen,
       wenn man das SQL Statement beenden moechte*/
    DELIMITER $$

    /* Datenbank-Prozedur, die den Zähler bei einer Anmeldung in der Tabelle "benutzer" inkrementiert */
    CREATE OR REPLACE PROCEDURE inkrementAnmeldung (
        IN benutzer_email varchar(100)
    )
    BEGIN
    UPDATE benutzer
    SET anzahlanmeldungen = anzahlanmeldungen + 1
    WHERE email = benutzer_email;
    END $$

    /*TODO: Louis: 5 b) Prozedur während der Anmeldung aus der Anwednung heraus aufrufen*/
    /*TODO: Louis: 5 c) Überlegen welche Prozeduren bei der E-Mensa noch denkbar wären*/

    DELIMITER ;