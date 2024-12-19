
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
SELECT gericht.name, kategorie.name as kategorie FROM kategorie
    left join gericht_hat_kategorie ON kategorie.id = kategorie_id
    left join gericht ON gericht.id = gericht_id WHERE gericht.name is NULL
union distinct
SELECT gericht.name, kategorie.name as kategorie FROM gericht
    left join gericht_hat_kategorie ON gericht.id = gericht_id
    left join kategorie ON kategorie_id = kategorie.id Where vegetarisch = 1;
/*TODO: Louis: (optional) 4 d)*/