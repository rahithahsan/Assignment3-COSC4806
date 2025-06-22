<?php
/** Tiny base controller — provides model() & view() helpers */
class Controller
{
    /** @param string $model file name (no extension) */
    public function model(string $model)
    {
        require_once MODELS . DS . $model . '.php';
        return new $model();
    }

    /** @param string $view path relative to /views (e.g. 'home/index') */
    public function view(string $view, array $data = []): void
    {
        require_once VIEWS . DS . $view . '.php';
    }
}
