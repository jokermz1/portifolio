<?php
/**
 * Partial: Links Manager
 * Variável esperada: $existingLinks — array de ['label'=>'...','url'=>'...']
 */
$existingLinks = $existingLinks ?? [];
?>
<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="bi bi-link-45deg" style="color:var(--accent);"></i>
        Links / URLs Externos
        <small style="color:var(--text-faint); margin-left:auto; font-weight:400;">Adiciona quantos quiseres</small>
    </div>
    <div class="card-body">
        <div id="links-list" style="display:flex; flex-direction:column; gap:8px;">
            <?php if ($existingLinks): ?>
                <?php foreach ($existingLinks as $i => $lnk): ?>
                <div class="link-row d-flex gap-2 align-items-center" data-index="<?= $i ?>">
                    <div class="input-group input-group-sm" style="max-width:180px;">
                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                        <input type="text" name="link_labels[]" class="form-control"
                               placeholder="Label (ex: GitHub)"
                               value="<?= htmlspecialchars($lnk['label'] ?? '') ?>">
                    </div>
                    <div class="input-group input-group-sm flex-grow-1">
                        <span class="input-group-text"><i class="bi bi-globe2"></i></span>
                        <input type="url" name="link_urls[]" class="form-control"
                               placeholder="https://..."
                               value="<?= htmlspecialchars($lnk['url'] ?? '') ?>">
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger flex-shrink-0"
                            onclick="this.closest('.link-row').remove()" title="Remover">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <button type="button" id="add-link-btn" class="btn btn-sm btn-outline-primary mt-3"
                onclick="addLinkRow()">
            <i class="bi bi-plus-circle me-1"></i>Adicionar URL
        </button>

        <div class="form-text mt-2" style="color:var(--text-faint); font-size:11px;">
            Label é opcional (ex: "GitHub", "Demo", "Figma"). URL é obrigatório para guardar.
        </div>
    </div>
</div>

<script>
function addLinkRow() {
    var row = document.createElement('div');
    row.className = 'link-row d-flex gap-2 align-items-center';
    row.innerHTML =
        '<div class="input-group input-group-sm" style="max-width:180px;">' +
            '<span class="input-group-text"><i class="bi bi-tag"></i></span>' +
            '<input type="text" name="link_labels[]" class="form-control" placeholder="Label (ex: GitHub)">' +
        '</div>' +
        '<div class="input-group input-group-sm flex-grow-1">' +
            '<span class="input-group-text"><i class="bi bi-globe2"></i></span>' +
            '<input type="url" name="link_urls[]" class="form-control" placeholder="https://">' +
        '</div>' +
        '<button type="button" class="btn btn-sm btn-outline-danger flex-shrink-0" ' +
            'onclick="this.closest(\'.link-row\').remove()" title="Remover">' +
            '<i class="bi bi-trash"></i>' +
        '</button>';
    document.getElementById('links-list').appendChild(row);
    row.querySelector('input[name="link_urls[]"]').focus();
}
</script>
