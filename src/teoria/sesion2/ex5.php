<style>
    body {
        margin: 0;
        padding: 30px 20px;
        background: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .contenidor {
        max-width: 460px;
        margin: 0 auto;
        text-align: center;
    }

    .titol {
        font-size: 26px;
        margin: 0 0 20px;
    }

    .temperatures {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
    }

    .caixa {
        width: 30%;
        box-sizing: border-box;
        padding: 10px 5px;
        border-radius: 4px;
        border: 1px solid black;
    }

    .graus {
        font-size: 20px;
        margin: 0 0 4px;
    }

    .tipus {
        font-size: 11px;
        margin: 0;
    }

    .fred {
        background: #0d6efd;
        border-color: #0a58ca;
        color: white;
    }

    .suau {
        background: #ffc107;
        border-color: #cc9a06;
        color: black;
    }

    .calor {
        background: #dc3545;
        border-color: #b02a37;
        color: white;
    }

    .mitjana {
        font-size: 18px;
        font-weight: bold;
    }
</style>

<?php $suma = 0; ?>

<div class="contenidor">

    <h1 class="titol">Classificació de Temperatures</h1>

    <div class="temperatures">
    <?php for ($i = 1; $i <= 10; $i++): ?>
        <?php 
        $temp = rand(-10, 40);
        $suma = $suma + $temp;

        if ($temp < 10) {
            $classe = "fred";
            $text = "Fred";
        } elseif ($temp <= 25) {
            $classe = "suau";
            $text = "Temperatura Suau";
        } else {
            $classe = "calor";
            $text = "Calor";
        }
        ?>
        <div class="caixa <?= $classe ?>">
            <h2 class="graus"><?= $temp ?>°C</h2>
            <p class="tipus"><?= $text ?></p>
        </div>
    <?php endfor; ?>
    </div>

    <div class="mitjana">Mitjana de les temperatures: <?= number_format($suma / 10, 2) ?>°C</div>

</div>