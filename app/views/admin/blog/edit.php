<?php
$pageTitle   = 'Editar Post — Admin';
$extraImages = json_decode($post['images'] ?? '[]', true) ?: [];
?>
<div class="page-header">
    <h1 class="page-title">Editar Post</h1>
    <a href="<?= BASE_URL ?>/admin/blog" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/blog/<?= $post['id'] ?>/edit" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">
        <!-- ── Coluna principal ── -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-journal-text me-2" style="color:var(--accent);"></i>Conteúdo</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Título <span style="color:#f87171;">*</span></label>
                        <input type="text" name="title" class="form-control"
                               required value="<?= htmlspecialchars($post['title']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Resumo</label>
                        <textarea name="excerpt" rows="2" class="form-control"><?= htmlspecialchars($post['excerpt'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Conteúdo</label>
                        <textarea name="content" rows="12" class="form-control"><?= htmlspecialchars($post['content'] ?? '') ?></textarea>
                        <div class="form-text" style="color:var(--text-faint);">Suporta HTML básico.</div>
                    </div>
                </div>
            </div>

            <!-- URLs -->
            <?php $existingLinks = json_decode($post['links'] ?? '[]', true) ?: []; ?>
            <?php View::partial('links-manager', ['existingLinks' => $existingLinks]); ?>

            <!-- Imagens -->
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-images me-2" style="color:var(--accent);"></i>Imagens</div>
                <div class="card-body">
                    <label class="form-label">Imagem de Capa</label>
                    <?php if (!empty($post['image'])): ?>
                    <div class="mb-2">
                        <img src="<?= UPLOAD_URL ?>posts/<?= htmlspecialchars($post['image']) ?>"
                             id="cover-img" style="height:100px; border-radius:8px; object-fit:cover; border:1px solid rgba(183,117,255,.2);" alt="">
                    </div>
                    <?php else: ?>
                    <div id="cover-preview" style="display:none;" class="mb-2">
                        <img id="cover-img" src="" alt="" style="height:100px; border-radius:8px; object-fit:cover; border:1px solid rgba(183,117,255,.2);">
                    </div>
                    <?php endif; ?>
                    <input type="file" name="image" id="cover-input" accept="image/*" class="form-control mb-1">
                    <small style="color:var(--text-faint); font-size:11px;">Deixe vazio para manter a actual.</small>

                    <?php if ($extraImages): ?>
                    <hr style="border-color:rgba(255,255,255,.07); margin:18px 0 14px;">
                    <label class="form-label">Imagens da Galeria <small style="color:var(--text-faint); font-weight:400;">— clica × para remover</small></label>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <?php foreach ($extraImages as $img): ?>
                        <div class="position-relative" id="wrap-<?= md5($img) ?>">
                            <img src="<?= UPLOAD_URL ?>posts/<?= htmlspecialchars($img) ?>"
                                 style="height:80px; width:80px; object-fit:cover; border-radius:8px; border:1px solid rgba(183,117,255,.2);" alt="">
                            <input type="hidden" name="keep_images[]" value="<?= htmlspecialchars($img) ?>">
                            <button type="button" onclick="removeImg('<?= md5($img) ?>')"
                                    style="position:absolute;top:-6px;right:-6px;width:20px;height:20px;border-radius:50%;background:#f87171;border:none;color:#fff;font-size:11px;cursor:pointer;display:flex;align-items:center;justify-content:center;padding:0;line-height:1;">×</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <label class="form-label">Adicionar Imagens <small style="color:var(--text-faint); font-weight:400;">(multi-selecção)</small></label>
                    <input type="file" name="images[]" id="gallery-input" accept="image/*" multiple class="form-control">
                    <div id="gallery-preview" class="d-flex flex-wrap gap-2 mt-3"></div>
                </div>
            </div>
        </div>

        <!-- ── Coluna lateral ── -->
        <div class="col-lg-4">
            <div class="card" style="position:sticky; top:20px;">
                <div class="card-header"><i class="bi bi-gear me-2" style="color:var(--accent);"></i>Publicação</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_published"
                               value="1" id="is_published"
                               <?= $post['is_published'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_published">Publicado</label>
                    </div>
                    <?php if ($post['published_at']): ?>
                    <p style="color:var(--text-muted); font-size:12px; margin-bottom:12px;">
                        <i class="bi bi-calendar3 me-1"></i>
                        Publicado em <?= date('d/m/Y H:i', strtotime($post['published_at'])) ?>
                    </p>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-circle me-1"></i>Guardar Alterações
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
