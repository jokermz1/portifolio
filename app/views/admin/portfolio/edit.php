<?php
$pageTitle   = 'Editar Projeto — Admin';
$extraImages = Project::galleryItems($project['images'] ?? '[]');
?>
<div class="page-header">
    <h1 class="page-title">Editar Projeto</h1>
    <div class="d-flex gap-2">
        <a href="<?= BASE_URL ?>/portfolio/<?= htmlspecialchars($project['slug']) ?>"
           target="_blank" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-eye me-1"></i>Ver no site
        </a>
        <a href="<?= BASE_URL ?>/admin/portfolio" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Voltar
        </a>
    </div>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/portfolio/<?= $project['id'] ?>/edit" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">
        <!-- ── Coluna principal ── -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-folder2 me-2" style="color:var(--accent);"></i>Informações do Projeto</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Título *</label>
                            <input type="text" name="title" value="<?= htmlspecialchars($project['title']) ?>"
                                   class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Categoria</label>
                            <input type="text" name="category" list="cat-list"
                                   value="<?= htmlspecialchars($project['category'] ?? '') ?>"
                                   class="form-control" placeholder="ex: Web Design">
                            <datalist id="cat-list">
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cliente</label>
                            <input type="text" name="client"
                                   value="<?= htmlspecialchars($project['client'] ?? '') ?>"
                                   class="form-control" placeholder="ex: Hachicko Tee">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descrição curta</label>
                            <textarea name="description" class="form-control"
                                      rows="2"><?= htmlspecialchars($project['description'] ?? '') ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Conteúdo</label>
                            <textarea name="content" class="form-control"
                                      rows="6"><?= htmlspecialchars($project['content'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- URLs -->
            <?php $existingLinks = json_decode($project['links'] ?? '[]', true) ?: []; ?>
            <?php View::partial('links-manager', ['existingLinks' => $existingLinks]); ?>

            <!-- Imagens -->
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-images me-2" style="color:var(--accent);"></i>Galeria de Imagens</div>
                <div class="card-body">
                    <!-- Capa -->
                    <label class="form-label">Imagem de Capa</label>
                    <?php if (!empty($project['image'])): ?>
                    <div class="mb-2">
                        <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($project['image']) ?>"
                             id="cover-img" style="height:100px; border-radius:8px; object-fit:cover; border:1px solid rgba(183,117,255,.2);" alt="">
                    </div>
                    <?php else: ?>
                    <div id="cover-preview" style="display:none;" class="mb-2">
                        <img id="cover-img" src="" alt="" style="height:100px; border-radius:8px; object-fit:cover; border:1px solid rgba(183,117,255,.2);">
                    </div>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control mb-1" accept="image/*" id="cover-input">
                    <small style="color:var(--text-faint); font-size:11px;">Deixe vazio para manter a actual.</small>

                    <!-- Galeria extra existente -->
                    <?php if ($extraImages): ?>
                    <hr style="border-color:rgba(255,255,255,.07); margin:18px 0 14px;">
                    <label class="form-label">Imagens da Galeria <small style="color:var(--text-faint); font-weight:400;">— dá um título a cada imagem · clica × para remover</small></label>
                    <div class="row g-3 mb-3" id="existing-gallery">
                        <?php foreach ($extraImages as $g): $file = $g['file']; $hash = md5($file); ?>
                        <div class="col-6 col-md-4" id="wrap-<?= $hash ?>">
                            <div class="position-relative">
                                <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($file) ?>"
                                     style="height:110px; width:100%; object-fit:cover; border-radius:8px; border:1px solid rgba(183,117,255,.2);" alt="">
                                <input type="hidden" name="keep_images[]" value="<?= htmlspecialchars($file) ?>">
                                <button type="button" onclick="removeImg('<?= $hash ?>')"
                                        style="position:absolute;top:-6px;right:-6px;width:22px;height:22px;border-radius:50%;background:#f87171;border:none;color:#fff;font-size:12px;cursor:pointer;display:flex;align-items:center;justify-content:center;padding:0;line-height:1;">×</button>
                            </div>
                            <input type="text" name="image_captions[<?= htmlspecialchars($file) ?>]"
                                   value="<?= htmlspecialchars($g['caption']) ?>"
                                   class="form-control form-control-sm mt-2" placeholder="Título da imagem">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Upload novos -->
                    <label class="form-label">Adicionar Imagens <small style="color:var(--text-faint); font-weight:400;">(multi-selecção)</small></label>
                    <input type="file" name="images[]" id="gallery-input" accept="image/*" multiple class="form-control">
                    <div id="gallery-preview" class="d-flex flex-wrap gap-2 mt-3"></div>
                </div>
            </div>
        </div>

        <!-- ── Coluna lateral ── -->
        <div class="col-lg-4">
            <div class="card" style="position:sticky; top:20px;">
                <div class="card-header"><i class="bi bi-toggles me-2" style="color:var(--accent);"></i>Publicação</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1"
                               id="is_published" <?= $project['is_published'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_published">Publicado</label>
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                               id="is_featured" <?= $project['is_featured'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_featured">Destacado na homepage</label>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Ordem</label>
                        <input type="number" name="sort_order" min="0"
                               value="<?= (int) ($project['sort_order'] ?? 0) ?>" class="form-control">
                        <small style="color:var(--text-faint); font-size:11px;">
                            <i class="bi bi-info-circle me-1"></i>0 = automático (por data). 1 = aparece primeiro, depois 2, 3…
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i>Guardar Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function removeImg(hash) {
    document.getElementById('wrap-' + hash).remove();
}
document.getElementById('cover-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    let img = document.getElementById('cover-img');
    const prev = document.getElementById('cover-preview');
    if (prev) prev.style.display = 'block';
    if (img) img.src = URL.createObjectURL(file);
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
