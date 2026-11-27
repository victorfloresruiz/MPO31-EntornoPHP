-- ReSell · Sprint 1 · Creació de la base de dades i dades de prova
-- ATENCIÓ: aquest script esborra les taules de ReSell i les torna a crear.
-- Executa'l a Adminer com a root (Importar o "Ordre SQL").

SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS resell
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Permisos per a l'usuari de classe (ha d'existir prèviament)
GRANT ALL PRIVILEGES ON resell.* TO 'mop31_user'@'%';

USE resell;

DROP TABLE IF EXISTS anuncis;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS usuaris;

CREATE TABLE usuaris (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom             VARCHAR(80)  NOT NULL,
    email           VARCHAR(150) NOT NULL UNIQUE,
    contrasenya     VARCHAR(255) NOT NULL,
    rol             ENUM('usuari', 'admin') NOT NULL DEFAULT 'usuari',
    data_registre   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE categories (
    id      INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom     VARCHAR(60) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE anuncis (
    id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titol            VARCHAR(120)  NOT NULL,
    descripcio       TEXT          NOT NULL,
    preu             DECIMAL(8,2)  NOT NULL,
    categoria_id     INT UNSIGNED  NOT NULL,
    usuari_id        INT UNSIGNED  NOT NULL,
    data_publicacio  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_anuncis_preu CHECK (preu > 0),
    CONSTRAINT fk_anuncis_categoria FOREIGN KEY (categoria_id)
        REFERENCES categories(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_anuncis_usuari FOREIGN KEY (usuari_id)
        REFERENCES usuaris(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Usuaris de prova (contrasenya de tots: demo1234, guardada amb password_hash)
INSERT INTO usuaris (id, nom, email, contrasenya, rol) VALUES
(1, 'Usuari Demo',  'demo@resell.test',  '$2y$10$vNVghcXiCg7/6Oe8Ni7LHODzkFQUKklOLzXZeIhkRhkK4/3s.Y5ua', 'usuari'),
(2, 'Laia Puig',    'laia@resell.test',  '$2y$10$vNVghcXiCg7/6Oe8Ni7LHODzkFQUKklOLzXZeIhkRhkK4/3s.Y5ua', 'usuari'),
(3, 'Marc Soler',   'marc@resell.test',  '$2y$10$vNVghcXiCg7/6Oe8Ni7LHODzkFQUKklOLzXZeIhkRhkK4/3s.Y5ua', 'usuari'),
(4, 'Administrador','admin@resell.test', '$2y$10$vNVghcXiCg7/6Oe8Ni7LHODzkFQUKklOLzXZeIhkRhkK4/3s.Y5ua', 'admin');

INSERT INTO categories (id, nom) VALUES
(1, 'Consoles'),
(2, 'Videojocs'),
(3, 'Ordinadors'),
(4, 'Mòbils'),
(5, 'Roba'),
(6, 'Bicicletes'),
(7, 'Altres');

INSERT INTO anuncis (titol, descripcio, preu, categoria_id, usuari_id, data_publicacio) VALUES
('Nintendo Switch OLED', 'Consola en molt bon estat, amb la base, els comandaments i el carregador originals.', 230.00, 1, 2, '2026-11-10 10:15:00'),
('PlayStation 4 Slim 500 GB', 'Funciona perfectament. Inclou un comandament i tots els cables.', 140.00, 1, 3, '2026-11-12 18:40:00'),
('Zelda: Breath of the Wild', 'Joc per a Nintendo Switch amb la caixa original.', 35.00, 2, 2, '2026-11-14 09:05:00'),
('EA Sports FC 25 PS4', 'Disc sense ratllades, jugat poques vegades.', 18.50, 2, 3, '2026-11-15 20:30:00'),
('Portàtil Lenovo IdeaPad', 'Pantalla de 15 polzades, 8 GB de RAM i SSD de 256 GB. Ideal per estudiar.', 260.00, 3, 1, '2026-11-17 12:00:00'),
('iPhone 12 128 GB', 'Color negre, bateria al 84 %. Amb funda i cable.', 245.00, 4, 2, '2026-11-18 16:25:00'),
('Xiaomi Redmi Note 11', 'Mòbil lliure, amb una petita marca a la part del darrere.', 75.00, 4, 1, '2026-11-20 11:10:00'),
('Jaqueta texana talla M', 'Jaqueta blava poc usada, sense cap desperfecte.', 20.00, 5, 3, '2026-11-21 17:45:00'),
('Bicicleta de muntanya 27,5"', 'Quadre d''alumini, 21 velocitats i frens de disc. Revisada fa poc.', 180.00, 6, 3, '2026-11-23 08:50:00'),
('Flexo d''escriptori LED', 'Llum amb tres nivells d''intensitat i connexió USB.', 12.00, 7, 2, '2026-11-25 19:20:00');
