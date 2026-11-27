-- ReSell · Consultes segons els casos d'ús
USE resell;

-- 1. Veure el catàleg amb el nom de la categoria i del propietari (JOIN)
SELECT a.id, a.titol, a.descripcio, a.preu, a.data_publicacio,
       c.nom AS categoria,
       u.nom AS propietari
FROM anuncis a
INNER JOIN categories c ON a.categoria_id = c.id
INNER JOIN usuaris u    ON a.usuari_id = u.id
ORDER BY a.data_publicacio DESC, a.id DESC;

-- 2. Carregar les categories al <select> del formulari
SELECT id, nom FROM categories ORDER BY nom;

-- 3. Publicar un anunci (al PHP els valors s'envien amb prepare() i execute())
INSERT INTO anuncis (titol, descripcio, preu, categoria_id, usuari_id)
VALUES ('Teclat mecànic', 'Teclat amb retroil·luminació.', 25.00, 3, 1);

-- 4. Veure la fitxa d'un anunci
SELECT a.titol, a.descripcio, a.preu, c.nom AS categoria, u.nom AS propietari
FROM anuncis a
INNER JOIN categories c ON a.categoria_id = c.id
INNER JOIN usuaris u    ON a.usuari_id = u.id
WHERE a.id = 1;

-- 5. Filtrar els anuncis per categoria
SELECT a.titol, a.preu, c.nom AS categoria
FROM anuncis a
INNER JOIN categories c ON a.categoria_id = c.id
WHERE c.id = 4;

-- 6. Consultar els anuncis d'un usuari
SELECT id, titol, preu FROM anuncis WHERE usuari_id = 1;

-- 7. Editar un anunci propi
UPDATE anuncis SET preu = 240.00 WHERE id = 5 AND usuari_id = 1;

-- 8. Eliminar l'anunci de prova creat a la consulta 3 (només si és propi)
DELETE FROM anuncis WHERE titol = 'Teclat mecànic' AND usuari_id = 1;

-- 9. Comptar anuncis per categoria (també les que no en tenen)
SELECT c.nom, COUNT(a.id) AS total
FROM categories c
LEFT JOIN anuncis a ON a.categoria_id = c.id
GROUP BY c.id, c.nom
ORDER BY c.nom;
