<?php

if (!function_exists('getStringLength')) {
    // Повертає довжину рядка без переносів рядків.
    function getStringLength(?string $text): int
    {
        return $text === null ? 0 : mb_strlen(str_replace(["\r", "\n"], '', $text), 'UTF-8');
    }
}
