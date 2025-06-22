<?php
/**
 * Tiny front-controller / router
 *   /controller/method/param1/…   (default: login@index)
 */class App
{
    protected $controller = 'login';   // <= untyped
    protected string $method = 'index';
    protected array  $params = [];

    public function __construct()
    {
        if (isset($_SESSION['auth'])) {
            $this->controller = 'home';
        }

        $url = $this->parseUrl();

        if (empty($url[1])) {
            $url[1] = 'login';
        }

        if (!empty($url[1]) &&
            file_exists(CONTROLLERS . DS . $url[1] . '.php')) {
            $this->controller = $url[1];
            unset($url[1]);
        }

        require_once CONTROLLERS . DS . $this->controller . '.php';
        $this->controller = new $this->controller;   // now allowed

        if (!empty($url[2]) &&
            method_exists($this->controller, $url[2])) {
            $this->method = $url[2];
            unset($url[2]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl(): array
    {
        $raw = $_SERVER['REQUEST_URI'] ?? '/';
        return explode('/', filter_var(rtrim($raw, '/'), FILTER_SANITIZE_URL));
    }
}

