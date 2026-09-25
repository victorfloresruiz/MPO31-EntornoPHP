<style>
    .par{
        background: red;
    }

    .inpar{
        background: cyan;
    }
</style>

<?php $num = rand(1, 100); ?>

<?php if($num % 2 == 0):?>
    <div class = "par">Es par</div>
    <?php else:?>
        <div class = "inpar">Es inpar</div>
        <?php endif;?>