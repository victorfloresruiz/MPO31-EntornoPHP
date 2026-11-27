<?php
require_once('config.php');

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id && is_numeric($id)) {
        $stmt = $pdo->prepare('DELETE FROM personatges WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}

header('Location: index.php');
exit;