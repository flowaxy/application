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
        // Начало буферизации вывода
        ob_start();
        require base_path("resources/views/{$path}.php");
        // Получаем весь вывод в переменную
        $content = ob_get_clean();

        if ($return) {
            // Если параметр $return true, возвращаем контент
            return $content;
        }
        // Иначе выводим контент
        echo $content;
        // Возвращаем null, если не требуется возвращать контент
        return null;
    }
}
