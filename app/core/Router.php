<?php
class Router {
    private array $routes = [];

    public function get(string $path, string $handler, array $middleware = []): void {
        $this->add('GET', $path, $handler, $middleware);
    }

    public function post(string $path, string $handler, array $middleware = []): void {
        $this->add('POST', $path, $handler, $middleware);
    }

    private function add(string $method, string $path, string $handler, array $middleware): void {
        $this->routes[] = compact('method', 'path', 'handler', 'middleware');
    }

    public function dispatch(string $method, string $uri): void {
        $base = rtrim(parse_url(BASE_URL, PHP_URL_PATH) ?? '', '/');
        if ($base && str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
        }
        $uri = '/' . trim($uri, '/');
        if ($uri === '') $uri = '/';

        // Allow POST tunneling for other verbs via hidden _method
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper(trim($_POST['_method']));
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== strtoupper($method)) continue;
            $params = $this->match($route['path'], $uri);
            if ($params !== false) {
                $this->runMiddleware($route['middleware']);
                $this->call($route['handler'], $params);
                return;
            }
        }

        http_response_code(404);
        if (file_exists(ROOT_PATH . '/app/views/errors/404.php')) {
            $settings = class_exists('Setting') ? (new Setting())->allKeyed() : [];
            View::render('errors/404', compact('settings'), 'main');
        } else {
            echo '<h1>404 — Página não encontrada</h1>';
        }
    }

    private function match(string $pattern, string $uri): array|false {
        $regex = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $pattern);
        $regex = '#^' . $regex . '$#u';
        if (preg_match($regex, $uri, $m)) {
            return array_filter($m, 'is_string', ARRAY_FILTER_USE_KEY);
        }
        return false;
    }

    private function runMiddleware(array $middleware): void {
        foreach ($middleware as $mw) {
            $class = ucfirst($mw) . 'Middleware';
            if (class_exists($class)) (new $class())->handle();
        }
    }

    private function call(string $handler, array $params): void {
        [$class, $method] = explode('@', $handler);
        if (!class_exists($class)) die("Controller não encontrado: {$class}");
        (new $class())->$method(...array_values($params));
    }
}
