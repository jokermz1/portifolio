<?php
/** Gestão das traduções da interface (ficheiros JSON por idioma). */
class AdminTranslationController extends Controller {
    public function index(): void {
        $this->requireAdmin();

        $langs        = Lang::available();
        $translations = [];
        foreach ($langs as $code => $_) {
            $translations[$code] = Lang::read($code);
        }

        // União de todas as chaves existentes em qualquer idioma.
        $keys = [];
        foreach ($translations as $strings) {
            $keys = array_merge($keys, array_keys($strings));
        }
        $keys = array_values(array_unique($keys));
        sort($keys, SORT_NATURAL | SORT_FLAG_CASE);

        $flash = $this->getFlash();
        $csrf  = $this->csrfToken();
        // NB: não usar 'data' como chave — colide com o extract($data) do View.
        $this->view('admin/translations/index', compact('langs', 'translations', 'keys', 'flash', 'csrf'), 'admin');
    }

    public function update(): void {
        $this->requireAdmin();
        $this->verifyCsrf();

        $langs   = array_keys(Lang::available());
        $keysIn  = $_POST['keys'] ?? [];   // keys[i]      = chave
        $valsIn  = $_POST['vals'] ?? [];   // vals[i][code]= valor
        $newKey  = trim($this->input('new_key', ''));

        // Parte das traduções em disco e aplica o que vem do formulário. Como a
        // tabela rende SEMPRE todas as chaves com o valor atual, o POST é a fonte
        // de verdade: dá para editar e também para LIMPAR (campo em branco →
        // tradução apagada). Chaves criadas noutro lado (ausentes do formulário)
        // preservam-se, pois $perLang começa a partir do disco.
        $perLang = [];
        foreach ($langs as $code) {
            $perLang[$code] = Lang::read($code);
        }

        foreach ($keysIn as $i => $key) {
            $key = trim((string) $key);
            if ($key === '') continue;
            foreach ($langs as $code) {
                $perLang[$code][$key] = trim((string) ($valsIn[$i][$code] ?? ''));
            }
        }

        // Nova chave (opcional) — começa com valores vazios em todos os idiomas.
        if ($newKey !== '') {
            foreach ($langs as $code) {
                if (!isset($perLang[$code][$newKey])) {
                    $perLang[$code][$newKey] = '';
                }
            }
        }

        foreach ($langs as $code) {
            Lang::write($code, $perLang[$code]);
        }

        $this->flash('success', 'Traduções guardadas com sucesso.');
        $this->redirect('/admin/translations');
    }
}
