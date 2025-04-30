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

    /**
     * Перевіряє існування директорії за відносним шляхом від кореня.
     *
     * @param string $path
     * @return bool
     */
    public static function e_dir(string $path): bool
    {
        return is_dir(base_path($path));
    }

    /**
     * Підключає компоненти з директорії.
     *
     * @param string $path
     * @param int $count
     * @param int $limit
     * @param string $ext
     * @param array $variables
     */
    public static function components(string $path, int $count = 1, int $limit = 100, string $ext = 'php', array $variables = [])
    {
        $fullPath = base_path($path);

        if (!is_dir($fullPath)) {
            echo "Директорія не знайдена";
            return;
        }

        $result = scandir($fullPath, SCANDIR_SORT_ASCENDING) ?: [];
        if (empty($result)) {
            echo "Помилка при відкритті директорії";
            return;
        }

        $fileCount = 0;

        foreach ($result as $file) {
            if (preg_match('#\.' . preg_quote($ext, '#') . '$#i', $file)) {
                $fileCount++;
                if ($fileCount >= $limit) break;

                if (!empty($variables) && is_array($variables)) {
                    extract($variables);
                }

                require $fullPath . DIRECTORY_SEPARATOR . $file;
            }
        }

        if ($fileCount === 0 && $count === 1) {
            echo "Поки пусто";
        }
    }
}
