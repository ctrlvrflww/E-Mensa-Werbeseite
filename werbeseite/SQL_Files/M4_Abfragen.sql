-- M4 Aufgabe 1 6)
-- Die letzten 5 Wunschgerichte:
SELECT name, beschreibung, datum, nummer FROM wunschgerichte ORDER BY nummer DESC LIMIT 5;
-- Anzahl der Geichte pro Ersteller:in:
SELECT e.email, COUNT(ew.erstellerin_email) AS Anzahl FROM wunschgerichte w
        RIGHT JOIN erstellerin_hat_wunschgerichte ew ON w.nummer = ew.wunschgerichtnummer
        RIGHT JOIN erstellerin e ON ew.erstellerin_email = e.email
        GROUP BY e.name
        ORDER BY Anzahl DESC ;