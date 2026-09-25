<?php 
$num = rand(0, 100); 
echo($num);
$chivato = 0;
?>

<?php for ($i = 1; $i <= 100; $i++): ?>
    <?php if ($num % $i == 0): ?>
        <div><?= $i ?></div>
        <?php $chivato = $chivato++;?>
    <?php endif; ?>
<?php endfor; ?>

<?php if ($chivato => 2):?>
    <div>Es primo</div>
    <?php else;?>
    <div>No es primo</div>