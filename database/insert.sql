INSERT INTO dn_note(n_creation_date, n_content)
VALUES (NOW(), 'Aller à la déchetterie'),
	(NOW(), 'Faire le point sur les prénoms'),
	(NOW(), 'Faire un framework perso pour simplifier HTML et CSS');

INSERT INTO dn_tag(t_name)
VALUES ('A faire'),
	('Info'),
	('Fait'),
	('Bébé'),
	('Elodie'),
	('Thomas'),
	('Nicolas'),
	('Quotidien'),
	('Maison'),
	('Voiture'),
	('Emploi'),
	('Formation'),
	('Rendez-vous'),
	('Projet perso');

INSERT INTO dn_note_tag(nt_note_id, nt_tag_name)
VALUES (1, 'Fait'),
	(1, 'Quotidien'),
	(2, 'A faire'),
	(2, 'Bébé'),
	(3, 'A faire'),
	(3, 'Projet perso');

