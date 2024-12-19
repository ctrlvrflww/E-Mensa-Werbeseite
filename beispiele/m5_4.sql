
/* SQL View die alle Suppen-Gerichte darstellt*/
CREATE VIEW view_suppengerichte AS
    SELECT id, name
    FROM gericht
    WHERE name LIKE '%suppe%' or name LIKE '%Suppe%';

/* SQL View die die Anzahl der Anmeldungen pro Benutzer absteigend sortiert und nach Anzahl der Anmeldungen darstellt*/
CREATE VIEW view_anmeldung AS
    SELECT anzahlanmeldungen, id
    FROM benutzer
    ORDER BY anzahlanmeldungen DESC;

/* SQL View die alle vegetarischen Gerichte, sowie die zugehörigen Kategorien zeigt. Kategorien werden dargestellt, auch wenn einer Kategorie kein Gericht zugeordnet ist*/
CREATE OR REPLACE VIEW view_kategoriegerichte_vegetarisch AS
       SELECT
        k.id AS kategorie_id,
        k.name AS kategorie_name,
        g.id AS gericht_id,
        g.name AS gericht_name
       FROM
        kategorie k
       LEFT JOIN
        gericht_hat_kategorie ghk
       ON
        k.id = ghk.kategorie_id
       LEFT JOIN
        gericht g
       ON
        ghk.gericht_id = g.id AND g.vegetarisch = TRUE;

/*TODO: Louis: (optional) 4 d)*/