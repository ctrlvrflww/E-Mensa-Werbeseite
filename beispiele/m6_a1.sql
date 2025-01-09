USE emensawerbeseite;

CREATE OR REPLACE TABLE bewertung(
    bewertung_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    bemerkung TEXT CHECK (CHAR_LENGTH(bemerkung) >= 5),
    hervorhebung BOOLEAN DEFAULT FALSE,
    sterne_bewertung ENUM ('sehr gut', 'gut','schlecht', 'sehr schlecht'),
    zeitpunkt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    benutzer_id BIGINT REFERENCES benutzer(id),
    gericht_id BIGINT REFERENCES gericht(id)

);

-- beispiel:

INSERT INTO bewertung(bemerkung, hervorhebung, sterne_bewertung, benutzer_id, gericht_id) VALUES
('Nicht anzeigen', false, 2, 3, 1);

-- neuer Nutzer:
INSERT INTO benutzer (`name`,`email`,`passwort`, `admin`, `anzahlanmeldungen`) values ('not Anou', 'notadmin@emensa.example', '2e06038a6b83c310f17ab46389bebae17db9ced6', false, 0);