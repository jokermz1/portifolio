<?php $pageTitle = 'Editar Post — Admin'; ?>
<div class="page-header">
    <h1 class="page-title">Editar Post</h1>
    <a href="<?= BASE_URL ?>/admin/blog" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/blog/<?= $post['id'] ?>/edit" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card mb-4">
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
                        <textarea name="content" rows="14" class="form-control"><?= htmlspecialchars($post['content'] ?? '') ?></textarea>
                        <div class="form-text" style="color:var(--text-faint);">Suporta HTML básico.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">Publicação</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_published"
                                   value="1" id="is_published"
                                   <?= $post['is_published'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_published">Publicado</label>
                        </div>
                    </div>
                    <?php if ($post['published_at']): ?>
                    <p style="color:var(--text-muted); font-size:12px; margin-bottom:12px;">
                        <i class="bi bi-calendar3 me-1"></i>
                        Publicado em <?= date('d/m/Y H:i', strtotime($post['published_at'])) ?>
                    </p>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-check-circle me-1"></i>Guardar Alterações
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Imagem de Capa</div>
                <div class="card-body">
                    <?php if (!empty($post['image'])): ?>
                    <div class="mb-3">
                        <img src="<?= UPLOAD_URL ?>posts/<?= htmlspecialchars($post['image']) ?>"
                             alt="" class="img-fluid rounded w-100"
                             style="object-fit:cover;max-height:160px;" id="img-preview">
                    </div>
                    <?php else: ?>
                    <div id="img-preview-wrap" class="mb-3 d-none">
                        <img id="img-preview" src="" alt="" class="img-fluid rounded w-100"
                             style="object-fit:cover;max-height:160px;">
                    </div>
                    <?php endif; ?>
                    <input type="file" name="image" id="image-input" accept="image/*" class="form-control">
                    <div class="form-text" style="color:var(--text-faint);">Deixe em branco para manter a imagem atual.</div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.getElementById('image-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    let img = document.getElementById('img-preview');
    if (!img) {
        const wrap = document.getElementById('img-preview-wrap');
        if (wrap) wrap.classList.remove('d-none');
        img = document.getElementById('img-preview');
    }
    if (img) img.src = URL.createObjectURL(file);
});
</script>
