<?php

namespace Application\Core;

abstract class BaseController
{
    protected function flash(string $type, string $message): void
    {
        Session::flash($type, $message);
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    protected function view(string $path, array $data = [], bool $return = false): ?string
    {
        extract($data);

        ob_start(); // Начало буферизации вывода
        require base_path("resources/views/{$path}.php");
        $content = ob_get_clean(); // Получаем весь вывод в переменную

        if ($return) {
            return $content; // Если параметр $return true, возвращаем контент
        }

        echo $content; // Иначе выводим контент

        return null; // Возвращаем null, если не требуется возвращать контент
    }
}
