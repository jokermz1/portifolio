<?php
/**
 * Sistema de internacionalização (i18n).
 *
 * As traduções vivem em ficheiros JSON simples (um por idioma) em /lang.
 * A chave de cada string é o próprio texto-fonte; se não houver tradução,
 * devolve-se o texto padrão (ou a própria chave) — nada fica "em branco".
 *
 * Traduz apenas as PALAVRAS DA INTERFACE (menus, botões, títulos fixos),
 * nunca o conteúdo criado pelos utilizadores (projetos, posts, comentários…).
 */
class Lang {
    private static string $current = 'en';
    private static array  $strings = [];

    /** Idiomas suportados: código => rótulo nativo. */
    private static array $available = [
        'pt' => 'Português',
        'en' => 'English',
        'fr' => 'Français',
        'es' => 'Español',
    ];

    /** Determina o idioma a partir da sessão/cookie (ou o padrão) e carrega-o. */
    public static function boot(): void {
        $code = $_SESSION['lang'] ?? ($_COOKIE['lang'] ?? DEFAULT_LANG);
        if (!isset(self::$available[$code])) {
            $code = self::$available[DEFAULT_LANG] ? DEFAULT_LANG : 'en';
        }
        self::$current = $code;
        self::$strings = self::read($code);
    }

    /** Define e persiste o idioma atual (sessão + cookie de 1 ano). */
    public static function set(string $code): void {
        if (!isset(self::$available[$code])) return;
        $_SESSION['lang'] = $code;
        setcookie('lang', $code, [
            'expires'  => time() + 60 * 60 * 24 * 365,
            'path'     => '/',
            'samesite' => 'Lax',
        ]);
        self::$current = $code;
        self::$strings = self::read($code);
    }

    public static function current(): string { return self::$current; }
    public static function available(): array { return self::$available; }
    public static function isValid(string $code): bool { return isset(self::$available[$code]); }

    /** Traduz uma chave; se não existir (ou estiver vazia), devolve o texto padrão (ou a própria chave). */
    public static function get(string $key, ?string $default = null): string {
        $val = self::$strings[$key] ?? '';
        return $val !== '' ? $val : ($default ?? $key);
    }

    /** Lê e devolve as traduções de um idioma. */
    public static function read(string $code): array {
        $file = LANG_PATH . '/' . basename($code) . '.json';
        if (!is_file($file)) return [];
        $data = json_decode((string) file_get_contents($file), true);
        return is_array($data) ? $data : [];
    }

    /** Grava as traduções de um idioma no respetivo JSON. */
    public static function write(string $code, array $strings): bool {
        if (!isset(self::$available[$code])) return false;
        if (!is_dir(LANG_PATH)) mkdir(LANG_PATH, 0775, true);
        ksort($strings);
        $json = json_encode(
            $strings,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
        return file_put_contents(LANG_PATH . '/' . basename($code) . '.json', $json) !== false;
    }
}

/** Atalho global de tradução. */
function t(string $key, ?string $default = null): string {
    return Lang::get($key, $default);
}

/** Igual a t(), mas já escapado para HTML. */
function e_t(string $key, ?string $default = null): string {
    return htmlspecialchars(Lang::get($key, $default), ENT_QUOTES, 'UTF-8');
}
