<?php $pageTitle = 'Novo Serviço — Admin'; ?>
<div class="page-header">
    <h1 class="page-title"><?= t('Novo Serviço') ?></h1>
    <a href="<?= BASE_URL ?>/admin/services" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i><?= t('Voltar') ?>
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <form method="POST" action="<?= BASE_URL ?>/admin/services/create" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-gear me-2" style="color:var(--accent);"></i><?= t('Informações') ?></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label"><?= t('Título') ?> <span style="color:#f87171;">*</span></label>
                        <input type="text" name="title" class="form-control"
                               required value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><?= t('Descrição') ?></label>
                        <textarea name="description" rows="4" class="form-control"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><?= t('Ícone (Iconify)') ?></label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <iconify-icon id="icon-preview" icon="<?= htmlspecialchars($_POST['icon'] ?? 'bi:star') ?>"
                                              style="font-size:1.4rem; color:var(--accent);"></iconify-icon>
                            </span>
                            <input type="text" name="icon" id="icon-input" class="form-control"
                                   placeholder="ex: bi:star  ou  mdi:web"
                                   value="<?= htmlspecialchars($_POST['icon'] ?? '') ?>">
                        </div>
                        <div class="form-text" style="color:var(--text-faint);">
                            Pesquise em <a href="https://icon-sets.iconify.design/" target="_blank" style="color:var(--accent);">icon-sets.iconify.design</a>.
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><?= t('Ordem') ?></label>
                            <input type="number" name="sort_order" min="0" class="form-control"
                                   value="<?= (int)($_POST['sort_order'] ?? 0) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?= t('Estado') ?></label>
                            <select name="is_active" class="form-select">
                                <option value="1" selected><?= t('Ativo') ?></option>
                                <option value="0"><?= t('Inativo') ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- URLs -->
            <?php $existingLinks = []; View::partial('links-manager', ['existingLinks' => $existingLinks]); ?>

            <!-- Imagens -->
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-images me-2" style="color:var(--accent);"></i><?= t('Imagens') ?></div>
                <div class="card-body">
                    <label class="form-label"><?= t('Imagem Principal') ?></label>
                    <input type="file" name="image" id="cover-input" accept="image/*" class="form-control mb-3">
                    <div id="cover-preview" style="display:none;" class="mb-3">
                        <img id="cover-img" src="" alt="" style="height:120px; border-radius:8px; object-fit:cover; border:1px solid rgba(183,117,255,.2);">
                    </div>

                    <label class="form-label"><?= t('Imagens Adicionais') ?> <small style="color:var(--text-faint); font-weight:400;"><?= t('(multi-selecção)') ?></small></label>
                    <input type="file" name="images[]" id="gallery-input" accept="image/*" multiple class="form-control">
                    <div id="gallery-preview" class="d-flex flex-wrap gap-2 mt-3"></div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-check-circle me-1"></i><?= t('Criar Serviço') ?>
                </button>
                <a href="<?= BASE_URL ?>/admin/services" class="btn btn-outline-secondary btn-sm"><?= t('Cancelar') ?></a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('icon-input').addEventListener('input', function () {
    document.getElementById('icon-preview').setAttribute('icon', this.value || 'bi:star');
});
document.getElementById('cover-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    document.getElementById('cover-img').src = URL.createObjectURL(file);
    document.getElementById('cover-preview').style.display = 'block';
});
document.getElementById('gallery-input').addEventListener('change', function () {
    const wrap = document.getElementById('gallery-preview');
    wrap.innerHTML = '';
    Array.from(this.files).forEach(function (file) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.style.cssText = 'height:80px; width:80px; object-fit:cover; border-radius:8px; border:1px solid rgba(183,117,255,.2);';
        wrap.appendChild(img);
    });
});
</script>
