<?php $pageTitle = 'Editar Serviço — Admin'; ?>
<div class="page-header">
    <h1 class="page-title">Editar Serviço</h1>
    <a href="<?= BASE_URL ?>/admin/services" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/services/<?= $service['id'] ?>/edit">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

            <div class="mb-3">
                <label class="form-label">Título <span style="color:#f87171;">*</span></label>
                <input type="text" name="title" class="form-control"
                       required value="<?= htmlspecialchars($service['title']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="description" rows="4"
                          class="form-control"><?= htmlspecialchars($service['description'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ícone (Iconify)</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <iconify-icon id="icon-preview" icon="<?= htmlspecialchars($service['icon'] ?? 'bi:star') ?>"
                                      style="font-size:1.4rem; color:var(--accent);"></iconify-icon>
                    </span>
                    <input type="text" name="icon" id="icon-input"
                           class="form-control"
                           placeholder="ex: bi:star  ou  mdi:web"
                           value="<?= htmlspecialchars($service['icon'] ?? '') ?>">
                </div>
                <div class="form-text" style="color:var(--text-faint);">
                    Pesquise em <a href="https://icon-sets.iconify.design/" target="_blank" style="color:var(--accent);">icon-sets.iconify.design</a> e cole o ID do ícone.
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ordem</label>
                    <input type="number" name="sort_order" min="0"
                           class="form-control"
                           value="<?= (int)$service['sort_order'] ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Estado</label>
                    <select name="is_active" class="form-select">
                        <option value="1" <?= $service['is_active'] ? 'selected' : '' ?>>Ativo</option>
                        <option value="0" <?= !$service['is_active'] ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-check-circle me-1"></i>Guardar Alterações
                </button>
                <a href="<?= BASE_URL ?>/admin/services" class="btn btn-outline-secondary btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('icon-input').addEventListener('input', function () {
    document.getElementById('icon-preview').setAttribute('icon', this.value || 'bi:star');
});
</script>
