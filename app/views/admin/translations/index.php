<?php
$pageTitle = 'Traduções — Admin';
// Conta as células por preencher (valor vazio em qualquer idioma) para o contador.
$untranslated = 0;
foreach ($keys as $k) {
    foreach ($langs as $code => $_) {
        if (($translations[$code][$k] ?? '') === '') $untranslated++;
    }
}
?>

<style>
/* Cabeçalho da tabela suspenso ao rolar (encosta logo abaixo da topbar de 56px) */
#tr-table-wrap { overflow: visible; }
#tr-table thead th {
    position: sticky;
    top: 56px;
    z-index: 15;
    background: var(--bg-content);
}
/* Realce das traduções ainda por preencher */
.tr-val.is-empty {
    border-color: rgba(251,191,36,.45);
    background: rgba(251,191,36,.06);
}
.tr-val.is-empty::placeholder { color: rgba(251,191,36,.55); }
.tr-badge-warn {
    display: inline-flex;
    align-items: center;
    font-size: 11px;
    font-weight: 600;
    color: #fbbf24;
    background: rgba(251,191,36,.12);
    border: 1px solid rgba(251,191,36,.28);
    border-radius: 999px;
    padding: 2px 10px;
    text-transform: none;
    letter-spacing: 0;
}
</style>

<div class="page-header">
    <div>
        <h1 class="page-title">Traduções da Interface</h1>
        <span style="font-size:12px; color:var(--text-faint);">
            Traduz apenas as palavras do sistema (menus, botões, títulos). O conteúdo criado não é afetado.
        </span>
    </div>
    <a href="<?= BASE_URL ?>/" target="_blank" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-eye me-1"></i>Ver Site
    </a>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/translations">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span>
                <i class="bi bi-translate me-2" style="color:var(--accent);"></i>Strings (<?= count($keys) ?>)
                <span id="tr-untranslated" class="tr-badge-warn<?= $untranslated ? '' : ' d-none' ?>" style="margin-left:8px;">
                    <i class="bi bi-exclamation-circle me-1"></i><span class="tr-untranslated-n"><?= $untranslated ?></span>&nbsp;por traduzir
                </span>
            </span>
            <input type="text" class="form-control form-control-sm" id="tr-filter"
                   placeholder="Filtrar…" style="max-width:220px;">
        </div>
        <div class="card-body p-0">
            <div class="table-responsive" id="tr-table-wrap">
                <table class="table table-hover align-middle mb-0" id="tr-table">
                    <thead>
                        <tr>
                            <th style="min-width:200px;">Chave (texto original)</th>
                            <?php foreach ($langs as $code => $label): ?>
                            <th><?= htmlspecialchars($label) ?> <small style="color:var(--text-faint);">(<?= strtoupper($code) ?>)</small></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($keys as $i => $key): ?>
                        <tr class="tr-row">
                            <td>
                                <input type="hidden" name="keys[<?= $i ?>]" value="<?= htmlspecialchars($key) ?>">
                                <code style="color:var(--text-muted); font-size:12px; white-space:normal; word-break:break-word;"><?= htmlspecialchars($key) ?></code>
                            </td>
                            <?php foreach ($langs as $code => $label): ?>
                            <td>
                                <input type="text" class="form-control form-control-sm tr-val<?= ($translations[$code][$key] ?? '') === '' ? ' is-empty' : '' ?>"
                                       name="vals[<?= $i ?>][<?= $code ?>]"
                                       value="<?= htmlspecialchars($translations[$code][$key] ?? '') ?>"
                                       placeholder="<?= htmlspecialchars($key) ?>">
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($keys)): ?>
                        <tr><td colspan="<?= count($langs) + 1 ?>">
                            <div class="empty-state">
                                <i class="bi bi-translate"></i>
                                <p>Ainda não há strings. Adiciona a primeira abaixo.</p>
                            </div>
                        </td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header"><i class="bi bi-plus-circle me-2" style="color:var(--accent);"></i>Nova string</div>
        <div class="card-body">
            <label class="form-label">Chave (texto original em inglês)</label>
            <input type="text" name="new_key" class="form-control" placeholder="ex: Read More">
            <div class="form-text">
                Depois de guardar, preenche as traduções na tabela acima. Usa esta mesma chave no código com <code>&lt;?= t('...') ?&gt;</code>.
                Para <strong>apagar</strong> uma tradução, deixa o campo em branco e grava.
            </div>
        </div>
    </div>

    <div class="pb-4">
        <button type="submit" class="btn btn-primary px-5">
            <i class="bi bi-save me-2"></i>Guardar Traduções
        </button>
    </div>
</form>

<script>
(function () {
    // Filtro simples da tabela de traduções
    var filter = document.getElementById('tr-filter');
    if (filter) {
        filter.addEventListener('input', function () {
            var q = this.value.toLowerCase();
            document.querySelectorAll('#tr-table .tr-row').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
            });
        });
    }

    // Realce dinâmico das traduções por preencher + contador ao vivo
    var badge  = document.getElementById('tr-untranslated');
    var badgeN = badge ? badge.querySelector('.tr-untranslated-n') : null;
    function refreshCount() {
        if (!badge) return;
        var n = document.querySelectorAll('#tr-table .tr-val.is-empty').length;
        badgeN.textContent = n;
        badge.classList.toggle('d-none', n === 0);
    }
    document.querySelectorAll('#tr-table .tr-val').forEach(function (inp) {
        inp.addEventListener('input', function () {
            this.classList.toggle('is-empty', this.value.trim() === '');
            refreshCount();
        });
    });
})();
</script>
