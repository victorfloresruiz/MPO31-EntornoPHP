<style>
    body {
        margin: 0;
        padding: 40px 20px;
    }

    .missatge {
        max-width: 300px;
        padding: 25px 20px;
        border: 1px solid black;
        border-radius: 8px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
    }

    .par {
        background: red;
        border-color: black;
        color: white;
    }

    .inpar {
        background: cyan;
        border-color: black;
        color: black;
    }
</style>

<?php $num = rand(1, 100); ?>

<?php if ($num % 2 == 0): ?>
    <div class="missatge par">Es par</div>
<?php else: ?>
    <div class="missatge inpar">Es inpar</div>
<?php endif; ?>