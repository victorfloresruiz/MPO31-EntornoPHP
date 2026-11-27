<?php
// Escapa el text abans de mostrar-lo dins de l'HTML (evita XSS).
function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// Mostra un preu amb format europeu: 1.234,50 €
function format_preu($preu): string
{
    return number_format((float) $preu, 2, ',', '.') . ' €';
}
