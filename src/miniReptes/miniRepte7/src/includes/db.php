<?php
// Connexió a la base de dades amb PDO
$host = 'db';
$dbname = 'resell';
$user = 'mop31_user';
$password = 'mop31_pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de connexió: ' . $e->getMessage());
}