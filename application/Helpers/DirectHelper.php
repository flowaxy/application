<?php

namespace Application\Helpers;

class DirectHelper
{
    /**
     * Перевіряє існування файлу за відносним шляхом від кореня.
     *
     * @param string $path
     * @return bool
     */
    public static function e_file(string $path): bool
    {
        return is_file(base_path($path));
    }

}
