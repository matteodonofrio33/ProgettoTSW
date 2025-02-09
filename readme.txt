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