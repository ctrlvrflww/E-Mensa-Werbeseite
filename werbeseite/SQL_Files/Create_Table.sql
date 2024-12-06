CREATE TABLE gericht (
     id int8 PRIMARY KEY ,
     name varchar(80) not null unique ,
     beschreibung varchar(800) not null ,
     erfasst_am date not null ,
     vegetarisch boolean not null ,
     vegan boolean not null ,
     preisintern double not null ,
     preisextern double not null ,
     CHECK ( preisintern > 0 ),
     CHECK ( preisextern > preisintern )
);

CREATE TABLE allergen (
      code char(4) not null PRIMARY KEY ,
      name varchar(300) not null ,
      typ varchar(20)  not null
);

CREATE TABLE kategorie (
        id int8 not null PRIMARY KEY ,
        name varchar(80) not null ,
        eltern_id int8,
        bildname varchar(200),
        CONSTRAINT e_id FOREIGN KEY (eltern_id) REFERENCES kategorie(id)
);

CREATE TABLE gericht_hat_allergen (
       code char(4),
       gericht_id int8 not null,
       CONSTRAINT al_code FOREIGN KEY (code) REFERENCES allergen(code),
       CONSTRAINT gea_id FOREIGN KEY (gericht_id) REFERENCES gericht(id)
);
CREATE TABLE gericht_hat_kategorie (
        gericht_id int8 not null ,
        kategorie_id int8 not null,
        CONSTRAINT kat_id FOREIGN KEY (kategorie_id) REFERENCES kategorie(id),
        CONSTRAINT gek_id FOREIGN KEY (gericht_id) REFERENCES gericht(id)
);

CREATE TABLE newsletter_anmeldungen(
        name varchar(30)  not null ,
        mail varchar(255) not null UNIQUE PRIMARY KEY ,
        sprache char(10) not null
);

CREATE TABLE besuche (
    ip varchar(255) not null,
    request_time varchar(255) not null,
    http_user_agent varchar(255) not null  unique primary key
);

CREATE TABLE wunschgerichte (
    name varchar(100) not null,              -- Gerichtname
    beschreibung varchar(2048) not null,     -- Beschreibung des Gerichtes und der Zubereitung
    datum varchar(32) not null,              -- Datum der Erstellung des Eintrages
    nummer int primary key auto_increment    -- generierte Nummer
);

CREATE TABLE erstellerin (
    name varchar(32) not null,                      -- Name des Ersteller, bei keiner Angabe "anonym"
    email varchar(128) not null unique PRIMARY KEY  -- Email von den Ersteller:in
);

CREATE TABLE erstellerin_hat_wunschgerichte (
    wunschgerichtnummer int not null REFERENCES wunschgerichte(nummer),
    erstellerin_email varchar(128) not null  REFERENCES erstellerin(email)
);
