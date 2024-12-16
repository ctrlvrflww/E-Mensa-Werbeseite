-- M4 Aufgabe 1 6)
-- Die letzten 5 Wunschgerichte:
SELECT name, beschreibung, datum, nummer FROM wunschgerichte ORDER BY nummer DESC LIMIT 5;

-- Anzahl der Geichte pro Ersteller:in:
SELECT e.email, COUNT(ew.erstellerin_email) AS Anzahl FROM wunschgerichte w
        RIGHT JOIN erstellerin_hat_wunschgerichte ew ON w.nummer = ew.wunschgerichtnummer
        RIGHT JOIN erstellerin e ON ew.erstellerin_email = e.email
        GROUP BY e.name
        ORDER BY Anzahl DESC ;

-- Aufgabe 4
-- 1) In Tabelle gericht_hat_kategorie soll eine Kombination aus Gericht und Kategorie einzigartig sein.
ALTER TABLE gericht_hat_kategorie ADD CONSTRAINT unique_kombi UNIQUE (gericht_id, kategorie_id);

-- 2) In der Tabelle gericht soll eine Abfrage nach Namen beschleunigt werden.
ALTER TABLE gericht ADD INDEX index_gerichtname (name);

-- 3) Bei Löschung eines Gerichts sollen 1) die zugehörigen Zuordnungen zu einer Kategorie sowie 2) die
-- zugehörigen Zuordnungen zu Allergenen automatisch mit gelöscht werden.
ALTER TABLE gericht_hat_kategorie
DROP FOREIGN KEY gek_id;
ALTER TABLE gericht_hat_allergen
DROP FOREIGN KEY gea_id;
ALTER TABLE gericht_hat_kategorie
ADD CONSTRAINT gek_id
FOREIGN KEY (gericht_id) REFERENCES gericht(id) ON DELETE CASCADE;
ALTER TABLE gericht_hat_allergen
ADD CONSTRAINT gea_id
FOREIGN KEY (gericht_id) REFERENCES gericht(id) ON DELETE CASCADE;

-- 4) Eine Kategorie kann nur dann gelöscht werden, wenn 1) dieser keine Gerichte zugeordnet sind und 2)
-- diese keine Kindkategorien besitzt.
ALTER TABLE gericht_hat_kategorie
DROP FOREIGN KEY kat_id;
ALTER TABLE gericht_hat_kategorie
ADD CONSTRAINT kat_id FOREIGN KEY (kategorie_id) REFERENCES kategorie(id)
ON DELETE RESTRICT;

ALTER TABLE kategorie
DROP FOREIGN KEY e_id;
ALTER TABLE kategorie
ADD CONSTRAINT e_id FOREIGN KEY (eltern_id) REFERENCES kategorie(id)
On DELETE RESTRICT;

-- 5) Wird der Code eines Allergens verändert, so ändert sich dieser Code automatisch in den referenzierenden Datensätzen.
ALTER TABLE gericht_hat_allergen
DROP FOREIGN KEY al_code;
ALTER TABLE gericht_hat_allergen
ADD CONSTRAINT al_code FOREIGN KEY (code) REFERENCES allergen(code)
ON UPDATE CASCADE;

-- 6) Eine Kombination aus gericht_id und kategorie_id in gericht_hat_kategorie soll als Primärschlüssel dienen
ALTER TABLE gericht_hat_kategorie
Add CONSTRAINT PRIMARY KEY (gericht_id, kategorie_id);

ALTER TABLE gericht ADD COLUMN bildname varchar(200) default null; -- Name der Bilddatei