<!doctype html>
<html lang="ca">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registre</title>
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
        <h1>Registre de jugador</h1>
        <p class="subtitol">Crea un compte per poder jugar.</p>
        <form action="#" method="post">
          <label class="camp"
            >Nom d'usuari<input
              type="text"
              name="usuari"
              placeholder="Ex.: anna"
              required /></label
          ><label class="camp"
            >Contrassenya<input
              type="password"
              name="password"
              required /></label
          ><label class="camp"
            >Repeteix la contrassenya<input
              type="password"
              name="password2"
              required /></label
          ><button class="btn" type="submit">Registrar-me</button>
        </form>
        <p class="nota">
          Els nous comptes han de tenir sempre el rol de jugador.
        </p>
      </section>
    </main>
    <footer class="peu">AQUEST FOOTER HA DE SER REUTILITZABLE</footer>
  </body>
</html>
