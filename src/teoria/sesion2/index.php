<style>
    body {
        margin: 0;
        padding: 40px 20px;
        background: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .contenidor {
        max-width: 700px;
        margin: 0 auto;
        text-align: center;
    }

    .titol {
        font-size: 30px;
        margin: 0 0 10px;
    }

    .subtitol {
        font-size: 16px;
        margin: 0 0 30px;
        color: #555555;
    }

    .targetes {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .targeta {
        width: 30%;
        box-sizing: border-box;
        padding: 25px 10px;
        background: #fdf5e6;
        border: 1px solid #bfe3f0;
        border-radius: 8px;
        text-decoration: none;
        color: black;
    }

    .targeta:hover {
        background: #a8dbe8;
        border-color: #4f8fa3;
    }

    .numero {
        font-size: 36px;
        margin: 0 0 8px;
    }

    .nom {
        font-size: 15px;
        margin: 0;
    }
</style>

<div class="contenidor">

    <h1 class="titol">Exercicis de PHP</h1>

    <h2 class="subtitol">Clica en una targeta per veure l'exercici</h2>

    <div class="targetes">

        <a class="targeta" href="ex1.php">
            <h3 class="numero">1</h3>
            <p class="nom">Exercici 1</p>
        </a>

        <a class="targeta" href="ex2.php">
            <h3 class="numero">2</h3>
            <p class="nom">Exercici 2</p>
        </a>

        <a class="targeta" href="ex3.php">
            <h3 class="numero">3</h3>
            <p class="nom">Exercici 3</p>
        </a>

        <a class="targeta" href="ex4.php">
            <h3 class="numero">4</h3>
            <p class="nom">Exercici 4</p>
        </a>

        <a class="targeta" href="ex5.php">
            <h3 class="numero">5</h3>
            <p class="nom">Exercici 5</p>
        </a>

    </div>

</div>