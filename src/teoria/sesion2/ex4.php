<style>
    body {
        margin: 0;
        padding: 40px 20px;
        background: #ffffff;
    }

    .contenidor {
        max-width: 560px;
        margin: 0 auto;
        padding: 30px 20px;
        background: #fdf5e6;
        border: 1px solid #bfe3f0;
        border-radius: 8px;
        text-align: center;
    }

    .titol {
        font-size: 22px;
        margin: 0 0 25px;
    }

    .subtitol {
        font-size: 16px;
        margin: 0 0 20px;
    }

    .divisors {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 25px;
    }

    .divisor {
        background: #a8dbe8;
        border: 1px solid #4f8fa3;
        border-radius: 4px;
        padding: 6px 9px;
        font-size: 13px;
    }

    .missatge {
        font-size: 16px;
    }

    .primer { 
        color: green; 
    }
    .no-primer { 
        color: red; 
    }
</style>

<div class="contenidor">

    <h1 class="titol">Nombre generat: <?php 
    $num = rand(1, 100); 
    echo($num);
    $chivato = 0;
    ?></h1>

    <h2 class="subtitol">Divisors de <?= $num ?>:</h2>

    <div class="divisors">
    <?php for ($i = 1; $i <= $num; $i++): ?>
        <?php if ($num % $i == 0): ?>
            <div class="divisor"><?= $i ?></div>
            <?php $chivato++;?>
        <?php endif; ?>
    <?php endfor; ?>
    </div>

    <?php if ($chivato == 2):?>
        <div class="missatge primer">Es primo</div>
        <?php else:?>
        <div class="missatge no-primer">No es primo</div>
    <?php endif;?>

</div>