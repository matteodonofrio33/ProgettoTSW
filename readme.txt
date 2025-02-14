assets: 	Contiene tutti i file statici come CSS, JavaScript e immagini.
pages: 		Contiene le pagine HTML specifiche.
includes: 	Contiene file riutilizzabili come header e footer, così puoi includerli facilmente in più pagine.
backend: 	Contiene i file di gestione (login, registrazione, ecc.).



password1 $2y$10$ucHyy67XRWP7k10yoWSQGuFTwFxhNHVCnTffdjK4oAKtT2Z1qAK0m

password2 $2y$10$GhMr7mpXMH.xAjvkSz6UE.9LbP3n2IWY4v2TM0h.XXeNDiGQEZtNS

password3 $2y$10$dYZlw2yaNkR4nQDM8Fd.reWIkF3WMGUkrHkClSe3ynS0qFM.Gleqm


INSERT INTO arbitro (username, email, nome, cognome, id_referto, password)
VALUES 
('arbitro1', 'arbitro1@email.com', 'Nome1', 'Cognome1', 101, '$2y$10$ucHyy67XRWP7k10yoWSQGuFTwFxhNHVCnTffdjK4oAKtT2Z1qAK0m'),
('arbitro2', 'arbitro2@email.com', 'Nome2', 'Cognome2', 102, '$2y$10$GhMr7mpXMH.xAjvkSz6UE.9LbP3n2IWY4v2TM0h.XXeNDiGQEZtNS'),
('arbitro3', 'arbitro3@email.com', 'Nome3', 'Cognome3', 103, '$2y$10$dYZlw2yaNkR4nQDM8Fd.reWIkF3WMGUkrHkClSe3ynS0qFM.Gleqm');



QUERY PER VISUALIZZARE LE PARTITE REFERTATE DA UN ARBITRO:
SELECT 
    REFERTO.id_referto,
    REFERTO.stato_partita,
    REFERTO.numero_falli,
    REFERTO.id_arbitro,
    PARTITA.id_partita,     -- Manteniamo una sola versione di id_partita
    PARTITA.n_giornata,     -- Numero della giornata
    PARTITA.data_partita,
    PARTITA.nome_squadra1,
    PARTITA.nome_squadra2,
    PARTITA.nome_stadio
FROM REFERTO
JOIN PARTITA ON REFERTO.id_partita = PARTITA.id_partita
WHERE REFERTO.id_arbitro = 'arbitro1';  -- Sostituisci con l'username dell'arbitro






INSERT INTO PARTITA (id_partita, data_partita, n_giornata, nome_stadio, nome_squadra1, nome_squadra2)
VALUES
    (4, '2025-02-13', 4, 'San Siro', 'Inter', 'Juventus'),
    (5, '2025-02-14', 5, 'Olimpico', 'Roma', 'Lazio'),
    (6, '2025-02-15', 6, 'Gewiss Stadium', 'Atalanta', 'Milan');






INSERT INTO REFERTO (id_referto, stato_partita, numero_falli, id_partita, id_arbitro)
VALUES
    (4, 'Vinta', 4, 4, 'arbitro1'),
    (5, 'Pareggiata', 3, 5, 'arbitro1'),
    (6, 'Persa', 5, 6, 'arbitro1');








problemi di visualizzazione: 
brew install git-lfs
git lfs install
