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