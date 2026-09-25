<style>
    body{
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .caja{
        border: 1px solid black;
        padding: 10px;
        align-self: flex-start; 
    }

    .caja1{
        background: pink;
    }

    .caja2{
        background: cyan;
    }

    .caja3{
        background: red;
    }

    .caja4{
        background: green;
    }

    .caja5{
        background: orange;
    }

    .caja6{
        background: yellow;
    }

    .caja7{
        background: darkcyan;
    }

    .caja8{
        background: violet;
    }

    .caja9{
        background: khaki;
    }

    .caja10{
        background: brown;
    }

    .caja11{
        background: seagreen;
    }

    ul{
        list-style: none;
        padding: 0;
        margin: 0;
    }
</style>

<?php for ($i = 1; $i <= 11; $i++): ?>
    <div class = "caja caja<?= $i?>">
        <h3>Taula del <?= $i ?></h3>
        <ul>
            <?php for ($j = 0; $j <= 10; $j++): ?>
                <li><?= $i ?> x <?= $j ?> = <?= $i * $j ?></li>
            <?php endfor; ?>
        </ul>
    </div>
<?php endfor; ?>