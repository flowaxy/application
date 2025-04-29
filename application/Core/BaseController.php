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

    protected function view(string $path, array $data = []): void
    {
        extract($data);
        require base_path("resources/views/{$path}.php");
    }
}
