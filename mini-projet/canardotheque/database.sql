CREATE DATABASE IF NOT EXISTS canardotheque CHARACTER SET utf8 COLLATE utf8_general_ci;
USE canardotheque;

CREATE TABLE etudiant (
    num_carte VARCHAR(20) PRIMARY KEY,
    nom       VARCHAR(100) NOT NULL,
    prenom    VARCHAR(100) NOT NULL,
    email     VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE canard (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    nom  VARCHAR(100) NOT NULL,
    type ENUM('Plastique', 'Peluche', 'Bouée') NOT NULL,
    etat ENUM('Dans la mare', 'En vadrouille', 'En nettoyage') NOT NULL DEFAULT 'Dans la mare'
);

CREATE TABLE emprunt (
    id                 INT AUTO_INCREMENT PRIMARY KEY,
    canard_id          INT NOT NULL,
    etudiant_id        VARCHAR(20) NOT NULL,
    date_pret          DATE NOT NULL,
    date_retour_prevue DATE NOT NULL,
    FOREIGN KEY (canard_id)   REFERENCES canard(id),
    FOREIGN KEY (etudiant_id) REFERENCES etudiant(num_carte)
);

-- Données de test
INSERT INTO etudiant VALUES
    ('ETU001', 'Dupont', 'Alice', 'alice.dupont@etudiant.fr'),
    ('ETU002', 'Martin', 'Bob',   'bob.martin@etudiant.fr'),
    ('ETU003', 'Leroy',  'Clara', 'clara.leroy@etudiant.fr');

INSERT INTO canard (nom, type, etat) VALUES
    ('Amiral Bec-Jaune',   'Plastique', 'Dans la mare'),
    ('Capitaine Moelleux', 'Peluche',   'Dans la mare'),
    ('La Grande Bouée',    'Bouée',     'En nettoyage'),
    ('Mini Couak',         'Plastique', 'Dans la mare');
