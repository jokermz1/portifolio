<?php
/** Troca o idioma da interface escolhido pelo visitante. */
class LangController extends Controller {
    public function set(string $code): void {
        Lang::set($code);

        // Volta para a página anterior (apenas se for do próprio site).
        $back = $_SERVER['HTTP_REFERER'] ?? '';
        if ($back === '' || strpos($back, BASE_URL) !== 0) {
            $back = BASE_URL . '/';
        }
        header('Location: ' . $back);
        exit;
    }
}
