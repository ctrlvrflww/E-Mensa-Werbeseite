-- 1) Zeigt alle Daten aller Gerichte --
SELECT * FROM gericht;

-- 2) Zeigt Name und Erfassungsdatum aller Gerichte --
SELECT name,erfasst_am FROM gericht;

-- 3) Zeige Name und ERfassungsdatum aller Gerichte (absteigend nach Gerichtname sortiert) --
SELECT name,erfasst_am FROM gericht ORDER BY name DESC ;

-- 4) Zeige Namen und Beschreibung von Gerichten (aufsteigend nach Namen sortiert) aber nur die ersten 5 Datensätze
SELECT name,beschreibung FROM gericht ORDER BY name ASC LIMIT 5;

-- 5) aus 4) abgeänderte Abfrage, sodass 10 Datensätze dargestellt werden, die nach den ersten 5 Folgen (Die ersten 5 Datensätze werden übersprungen) --
SELECT name, beschreibung FROM gericht ORDER BY name ASC LIMIT 10 OFFSET 5;

-- 6) Zeige alle möglichen Allergen-Typen (typ), ohne Dopplungen --
SELECT DISTINCT typ FROM allergen;

-- 7) Zeige alle Namen von Gerichten, deren Name mit einem klein-oder großgeschriebenen "L" beginnt --
SELECT name FROM gericht WHERE name LIKE 'l%' OR name LIKE 'L%';

-- 8) Zeige ID's und Namen von gerichten, deren Namen eine "suppe" an beliebiger Stelle enthält (absteigend sortiert nach Namen) --
SELECT id,name FROM gericht WHERE name LIKE '%suppe%' ORDER BY name DESC;

-- 9) ALle Kategorien, die keine Elterneinträge besitzen --
SELECT name FROM kategorie WHERE eltern_id IS NULL;

-- 10) Korrigiere Wert "Dinkel" in Tabelle Allergen mit dem Code a6 zu "Kamut"
UPDATE allergen SET name = 'Kamut' WHERE code ='a6';

-- Gericht "Currywurst mit Pommes" hinzufügen und in Kategorie "Hauptspeise" eintragen --
INSERT INTO gericht VALUES(21, 'Currywurst mit Pommes','','2024-11-18','0','0','0','0');
INSERT INTO gericht_hat_kategorie VALUES ('21','3');

-- Aufgabe 6: Allergene

-- 1) Alle Gerichte mit allen zugehörigen Allergenen.
SELECT g.name,a.name FROM gericht g
            INNER JOIN gericht_hat_allergen ga ON g.id = ga.gericht_id
            INNER JOIN  allergen a ON ga.code = a.code;

-- 2) Ändern Sie die vorherige Abfrage so ab, dass alle existierenden Gerichte
-- dargestellt werden (auch wenn keine Allergene enthalten sind).
SELECT g.name,a.name FROM gericht g
            LEFT JOIN gericht_hat_allergen ga ON g.id = ga.gericht_id
            LEFT JOIN  allergen a ON ga.code = a.code ;

-- 3) Ändern Sie die vorherige Abfrage so ab, so dass im Ergebnis alle
-- existierenden Allergene dargestellt werden (auch wenn diese nicht einem
-- Gericht zugeordnet sind).
SELECT g.name,a.name FROM gericht g
            RIGHT JOIN gericht_hat_allergen ga ON g.id = ga.gericht_id
            RIGHT JOIN  allergen a ON ga.code = a.code;

-- 4) Die Anzahl der Gerichte pro Kategorie aufsteigend sortiert nach Anzahl.
SELECT k.name, COUNT(gk.gericht_id) AS Anzahl FROM gericht g
            RIGHT JOIN gericht_hat_kategorie gk ON g.id = gk.gericht_id
            RIGHT JOIN kategorie k ON gk.kategorie_id = k.id
            GROUP BY k.name
            ORDER BY Anzahl ASC;
-- 5) Ändern Sie die vorherige Abfrage so ab, dass dabei nur die Kategorien
-- dargestellt werden, die mehr als 2 Gerichte besitzen.
SELECT k.name, COUNT(gk.gericht_id) AS Anzahl FROM gericht g
            RIGHT JOIN gericht_hat_kategorie gk ON g.id = gk.gericht_id
            RIGHT JOIN kategorie k ON gk.kategorie_id = k.id
            GROUP BY k.name
            HAVING Anzahl>= 2
            ORDER BY Anzahl ASC;
-- 6) Alle Gerichte, die vier oder mehr Allergene aufweisen
SELECT g.name, COUNT(ga.code) AS Anzahl  FROM gericht g
            RIGHT JOIN gericht_hat_allergen ga ON g.id = ga.gericht_id
            RIGHT JOIN allergen a ON ga.code = a.code
            GROUP BY g.name
            HAVING Anzahl >= 4;