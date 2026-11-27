# ReSell · Sprint 1

## Contingut
- `docs/diagrama_er.pdf`: diagrama entitat-relació
- `sql/resell.sql`: creació de les taules i dades de prova
- `sql/consultes.sql`: consultes dels casos d'ús
- `src/`: codi PHP i CSS

## Posada en marxa
1. Engega l'entorn Docker de classe: `docker compose up -d`.
2. Obre Adminer (http://localhost:8081), servidor `db`, entra com a `root` (contrasenya a `MYSQL_ROOT_PASSWORD`) i executa `sql/resell.sql`.
   Si el teu usuari no és `mop31_user`, canvia la línia `GRANT`.
3. Copia el contingut de `src/` a la carpeta `src/resell/` de l'entorn Docker.
4. Comprova que les dades de `includes/db.php` coincideixen amb el `docker-compose.yml`.
5. Obre http://localhost:8080/resell/

## Comprovacions del Sprint 1
- [ ] Hi ha almenys 5 categories (l'script en crea 7).
- [ ] Hi ha almenys 8 anuncis (l'script en crea 10).
- [ ] Modificar un anunci des d'Adminer i veure el canvi al navegador.
- [ ] Publicar almenys 2 anuncis des del formulari.
- [ ] `docker compose restart` i comprovar que les dades persisteixen
      (no facis servir `docker compose down -v`, que esborra els volums).

## Captures per lliurar
- [ ] Catàleg
- [ ] Formulari
- [ ] Consulta JOIN (consulta 1 de `consultes.sql`) executada a Adminer
