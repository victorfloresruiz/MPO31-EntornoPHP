<!doctype html>
<html lang="ca">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trivial</title>
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
      <section class="panell">
        <h1>Hola, Anna!</h1>
        <p class="subtitol">Respon la pregunta i continua avançant.</p>
        <div class="estadistiques">
          <span><strong>Puntuació:</strong> 2 punts</span
          ><span><strong>Progrés:</strong> 3 de 8</span
          ><span><strong>Pendents:</strong> 6</span>
        </div>
        <span class="etiqueta">Geografia</span>
        <h2 style="margin-top: 15px">
          Quin és el continent amb més superfície?
        </h2>
        <form method="post" action="#">
          <label class="resposta"
            ><input
              type="radio"
              name="resposta"
              value="0"
              required
            />Europa</label
          ><label class="resposta"
            ><input type="radio" name="resposta" value="1" />Àsia</label
          ><label class="resposta"
            ><input type="radio" name="resposta" value="2" />Àfrica</label
          ><label class="resposta"
            ><input type="radio" name="resposta" value="3" />Amèrica del
            Sud</label
          ><button class="btn" type="submit">Comprovar resposta</button>
        </form>
        <div class="alerta">
          Exemple visual del missatge d'encert (no és una resposta calculada).
        </div>
        <p class="nota">
          La pregunta, la puntuació i el progrés són dades fictícies. La versió
          PHP ha d'obtenir-les de la sessió.
        </p>
      </section>
    </main>
    <footer class="peu">AQUEST FOOTER HA DE SER REUTILITZABLE</footer>
  </body>
</html>
