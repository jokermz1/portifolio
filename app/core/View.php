<?php
class View {
    public static function render(string $view, array $data = [], string $layout = 'main'): void {
        extract($data, EXTR_SKIP);
        $viewPath = ROOT_PATH . '/app/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(404);
            die("View não encontrada: {$view}");
        }

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        if ($layout) {
            $layoutPath = ROOT_PATH . '/app/views/layouts/' . $layout . '.php';
            if (file_exists($layoutPath)) {
                require $layoutPath;
                return;
            }
        }
        echo $content;
    }

    public static function partial(string $partial, array $data = []): void {
        extract($data, EXTR_SKIP);
        $path = ROOT_PATH . '/app/views/partials/' . $partial . '.php';
        if (file_exists($path)) require $path;
    }

    public static function inc(string $file, array $data = []): void {
        extract($data, EXTR_SKIP);
        $path = ROOT_PATH . '/includes/' . $file . '.php';
        if (file_exists($path)) require $path;
    }
}
