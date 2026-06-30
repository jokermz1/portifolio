<?php $pageTitle = 'Novo Post — Admin'; ?>
<div class="page-header">
    <h1 class="page-title">Novo Post</h1>
    <a href="<?= BASE_URL ?>/admin/blog" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/blog/create" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">
        <!-- ── Coluna principal ── -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-journal-text me-2" style="color:var(--accent);"></i>Conteúdo</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Título <span style="color:#f87171;">*</span></label>
                        <input type="text" name="title" class="form-control" required
                               placeholder="Título do post" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Resumo</label>
                        <textarea name="excerpt" rows="2" class="form-control"
                                  placeholder="Breve resumo exibido na listagem…"><?= htmlspecialchars($_POST['excerpt'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Conteúdo</label>
                        <textarea name="content" rows="12" class="form-control"
                                  placeholder="Conteúdo completo do post…"><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>
                        <div class="form-text" style="color:var(--text-faint);">Suporta HTML básico.</div>
                    </div>
                </div>
            </div>

            <!-- URLs -->
            <?php $existingLinks = []; View::partial('links-manager', ['existingLinks' => $existingLinks]); ?>

            <!-- Galeria -->
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-images me-2" style="color:var(--accent);"></i>Imagens</div>
                <div class="card-body">
                    <label class="form-label">Imagem de Capa</label>
                    <input type="file" name="image" id="cover-input" accept="image/*" class="form-control mb-3">
                    <div id="cover-preview" style="display:none;" class="mb-3">
                        <img id="cover-img" src="" alt="" style="height:120px; border-radius:8px; object-fit:cover; border:1px solid rgba(183,117,255,.2);">
                    </div>

                    <label class="form-label">Imagens Adicionais <small style="color:var(--text-faint); font-weight:400;">(multi-selecção)</small></label>
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
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_published"
                               value="1" id="is_published"
                               <?= !empty($_POST['is_published']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_published">Publicar agora</label>
                    </div>
                    <div class="form-text mb-3" style="color:var(--text-faint);">Se desmarcado, fica como rascunho.</div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-circle me-1"></i>Criar Post
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
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
