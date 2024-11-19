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
        FOREIGN KEY (eltern_id) REFERENCES kategorie(id)
);

CREATE TABLE gericht_hat_allergen (
       code char(4),
       gericht_id int8 not null,
       FOREIGN KEY (code) REFERENCES allergen(code),
       FOREIGN KEY (gericht_id) REFERENCES gericht(id)
);
CREATE TABLE gericht_hat_kategorie (
        gericht_id int8 not null ,
        kategorie_id int8 not null,
        FOREIGN KEY (kategorie_id) REFERENCES kategorie(id),
        FOREIGN KEY (gericht_id) REFERENCES gericht(id)
);
