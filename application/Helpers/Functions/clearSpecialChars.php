<?php

if (!function_exists('clearSpecialChars')) {
    // Очищає рядок від спеціальних символів.
    function clearSpecialChars(string $text): string
    {
        $special_chars = array(
            '?',
            '[',
            ']',
            '/',
            '\\',
            '=',
            '<',
            '>',
            ':',
            ';',
            ',',
            "'",
            '"',
            '&',
            '$',
            '#',
            '*',
            '(',
            ')',
            '|',
            '~',
            '`',
            '!',
            '{',
            '}',
            '%',
            '+',
            chr(0)
        );

        // Замінюємо нерозривний пробіл на звичайний
        $text = preg_replace("#\x{00a0}#siu", ' ', $text);

        // Видаляємо спецсимволи
        $text = str_replace($special_chars, '', $text);

        // Видаляємо залишки пробілів та певні символи на краях
        $text = str_replace(array('%20', '+'), '', $text);
        $text = trim($text, '.-_');

        return htmlspecialchars($text);
    }
}
