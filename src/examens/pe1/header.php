<header class="cap">
    <div class="contenidor navegacio">
        <a class="marca" href="index.php">TRIVIAL Pe1</a>
        <nav class="enllacos">
            <a href="index.php">Inici</a>
            <?php if (isset($_SESSION["usuari_actiu"])) { ?>
                <?php if ($_SESSION["usuari_actiu"]["rol"] == "admin") { ?>
                    <a href="admin.php">Administració</a>
                <?php } else { ?>
                    <a href="joc.php">Joc</a>
                <?php } ?>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="registre.php">Registre</a>
                <a href="login.php">Login</a>
            <?php } ?>
        </nav>
    </div>
</header>