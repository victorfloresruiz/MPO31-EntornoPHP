<?php 
$num = rand(0, 100); 
echo($num);
?>

<?php for ($i = 1; $i <= 100; $i++): ?>
    <?php if ($num % $i == 0): ?>
        <div><?= $i ?></div>
    <?php endif; ?>
<?php endfor; ?>