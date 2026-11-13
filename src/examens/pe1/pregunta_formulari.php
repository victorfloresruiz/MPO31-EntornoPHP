<!doctype html>
<html lang="ca">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pregunta</title>
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
        <!-- AQUEST HEADER HA DE SER REUTILITZABLE -->

    <header class="cap">
      <div class="contenidor navegacio">
        <a class="marca" href="index.html">TRIVIAL Pe1</a>
        <nav class="enllacos">
          <a href="index.html">Inici</a><a href="registre.html">Registre</a
          ><a href="login.html">Login</a><a href="joc.html">Joc</a
          ><a href="admin.html">Administració</a>
        </nav>
      </div>
    </header>
    <main class="contenidor">
      <section class="panell ample-mig">
        <h1>Crear o editar pregunta</h1>
        <p class="subtitol">
          El mateix formulari pot servir per a les dues operacions.
        </p>
        <form action="#" method="post">
          <label class="camp"
            >Categoria<select name="categoria" required>
              <option value="">Selecciona una categoria</option>
              <option>Geografia</option>
              <option>Història</option>
              <option>Ciència i natura</option>
              <option>Art i cultura</option>
            </select></label
          ><label class="camp"
            >Enunciat<textarea
              name="pregunta"
              required
              placeholder="Escriu l'enunciat..."
            ></textarea></label
          ><label class="camp"
            >Opció A<input type="text" name="opcio_0" required /></label
          ><label class="camp"
            >Opció B<input type="text" name="opcio_1" required /></label
          ><label class="camp"
            >Opció C<input type="text" name="opcio_2" required /></label
          ><label class="camp"
            >Opció D<input type="text" name="opcio_3" required /></label
          ><label class="camp"
            >Resposta correcta<select name="correcta" required>
              <option value="0">A</option>
              <option value="1">B</option>
              <option value="2">C</option>
              <option value="3">D</option>
            </select></label
          >
          <div class="accions">
            <button class="btn" type="submit">Guardar pregunta</button
            ><a class="btn btn-sec" href="admin.html">Cancel·lar</a>
          </div>
        </form>
      </section>
    </main>
    <footer class="peu">AQUEST FOOTER HA DE SER REUTILITZABLE</footer>
  </body>
</html>
