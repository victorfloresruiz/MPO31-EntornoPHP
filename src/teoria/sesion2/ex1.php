<style>
    body{
        display: flex;
        flex-wrap: wrap; 
        gap: 10px;
        padding: 20px;
    }

  div{
        width: 100px;
        background: cyan;
        border: 1px solid black;
        padding: 10px;
        text-align: center;
    }
</style>

<?php for($i = 50; $i <= 500; $i = $i+2):?>
    <div>Caixa <?= $i ?></div>
    <?php endfor; ?>
