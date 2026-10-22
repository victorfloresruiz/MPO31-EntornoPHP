<style>
    header {
        background-color: #2e7d32;
        color: white;
        padding: 10px 20px;
        text-align: center;
    }
    header h1 {
        margin: 5px 0;
    }
    header img.perfil {
        border-radius: 50%;
        border: 2px solid white;
    }
</style>

<header>
    <img src="https://logos-world.net/wp-content/uploads/2022/04/Mercadona-Symbol.png" alt="" width="100">
    <h1>Vamos al Mercadona</h1>

    <?php
    if ($nombre != "" && $foto != "") {
        echo "<p>Bienvenido, " . $nombre . "</p>";
        echo "<img class='perfil' src='" . $foto . "' alt='' width='60'>";
    }
    ?>
</header>