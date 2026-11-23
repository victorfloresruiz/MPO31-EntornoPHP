<?php
session_start();

/**
 * Retorna una connexió PDO amb la base de dades.
 */
function db(): PDO
{
    // Reutilitzarem la mateixa connexió si ja l'hem creat abans.
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    // Carreguem les dades de connexió des de config.local.php
    $config = require ('config.local.php');

    // Construïm el DSN: indica a PDO on és la base de dades.
    $dsn =
        "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";

    // Creem la connexió PDO.
    $pdo = new PDO(
        $dsn,
        $config['user'],
        $config['password'],
        [
            // Si hi ha un error SQL, PDO llança una excepció.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Els resultats es retornaran com arrays associatius.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    return $pdo;
}