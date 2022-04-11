- Ristoratori (UR)
    -ID | PK AI BIGINT NOTNULL UNIQUE
    -cover | VARCHAR(255)
    -logo | VARCHAR(40)
    -email | VARCHAR(40) UNIQUE NOTNULL
    -password | VARCHAR(40) NOTNULL
    -Nome attività | VARCHAR(50) NOTNULL UNIQUE
    -indirizzo | VARCHAR(60) NOTNULL
    -PIVA | CHAR(11) NOT NULL UNIQUE
    -Tipologie | tabella many to many
    -Piatti | tabella one to many


- Piatti
    -Piatto singolo
        - ID | PK AI BIGINT NOTNULL UNIQUE
        - cover | VARCHAR(40)
        - Nome piatto | VARCHAR(40) NOTNULL
        - Ingredienti | VARCHAR(255) 
        - Descrizione | 
        - Prezzo | float (5,2)
        - visibilità | boolean

- Tipologie
    - ID | PK AI BIGINT NOTNULL UNIQUE
    - Nome | VARCHAR(40)

- Ordini
    - ID | PK AI BIGINT NOTNULL UNIQUE
    - spesa_piatti | float (6,2)
    - spese_consegna | float (3,2)
    - prezzo_totale | float (6,2)
    -
    -
    -