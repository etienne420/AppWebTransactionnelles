USE projet_db;

INSERT INTO utilisateur (id_utilisateur, nom, courriel, mot_de_passe, role) VALUES (1, 'Bob', 'Bob123@gmail.com', 'abc123', 'admin');
INSERT INTO utilisateur (id_utilisateur, nom, courriel, mot_de_passe, role) VALUES (2, 'John', 'JohnDubDub@hotmail.com', 'password', 'joueur');
INSERT INTO utilisateur (id_utilisateur, nom, courriel, mot_de_passe, role) VALUES (3, 'Tony', 'TonySoprano@email.com', 'chrissy1324', 'joueur');

INSERT INTO jeu (id_jeu, titre, genre, annee_sortie, description) VALUES (1, 'GTA5', 'action', '2013', 'Grand Thieft Auto 5 par Rockstar');
INSERT INTO jeu (id_jeu, titre, genre, annee_sortie, description) VALUES (2, 'Minecraft', 'Survie', 2011, 'Jeu de construction et de survie');
INSERT INTO jeu (id_jeu, titre, genre, annee_sortie, description) VALUES (3, 'Elden Ring', 'RPG', 2022, 'Jeu de role en monde ouvert');

INSERT INTO librairie (id_librairie, id_utilisateur, id_jeu, date_ajout) VALUES (1, 2, 1, '2026-09-01');
INSERT INTO librairie (id_librairie, id_utilisateur, id_jeu, date_ajout) VALUES (2, 2, 3, '2026-09-02');
INSERT INTO librairie (id_librairie, id_utilisateur, id_jeu, date_ajout) VALUES (3, 3, 2, '2026-09-03');
INSERT INTO librairie (id_librairie, id_utilisateur, id_jeu, date_ajout) VALUES (4, 3, 1, '2026-09-04');

INSERT INTO evaluation (id_evaluation, id_utilisateur, id_jeu, note, commentaire) VALUES (1, 2, 1, 9, 'Excellent jeu, beaucoup de contenu et une grande liberté.');
INSERT INTO evaluation (id_evaluation, id_utilisateur, id_jeu, note, commentaire) VALUES (2, 2, 3, 10, 'Un excellent RPG avec un monde immense et beaucoup de boss.');
INSERT INTO evaluation (id_evaluation, id_utilisateur, id_jeu, note, commentaire) VALUES (3, 3, 2, 8, 'Très amusant, surtout avec des amis.');

SELECT * FROM librairie;
SELECT * FROM utilisateur;
SELECT * FROM jeu;
SELECT * FROM evaluation;
