<?php $pageTitle = 'Novo Post — Admin'; ?>
<div class="page-header">
    <h1 class="page-title">Novo Post</h1>
    <a href="<?= BASE_URL ?>/admin/blog" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/blog" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Título <span style="color:#f87171;">*</span></label>
                        <input type="text" name="title" class="form-control"
                               required placeholder="Título do post"
                               value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Resumo</label>
                        <textarea name="excerpt" rows="2" class="form-control"
                                  placeholder="Breve resumo exibido na listagem…"><?= htmlspecialchars($_POST['excerpt'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Conteúdo</label>
                        <textarea name="content" rows="14" class="form-control"
                                  placeholder="Conteúdo completo do post…"><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>
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
                                   <?= !empty($_POST['is_published']) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_published">Publicar agora</label>
                        </div>
                        <div class="form-text" style="color:var(--text-faint);">Se desmarcado, fica como rascunho.</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-check-circle me-1"></i>Criar Post
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Imagem de Capa</div>
                <div class="card-body">
                    <div id="img-preview-wrap" class="mb-3 d-none">
                        <img id="img-preview" src="" alt="" class="img-fluid rounded w-100"
                             style="object-fit:cover;max-height:160px;">
                    </div>
                    <input type="file" name="image" id="image-input" accept="image/*" class="form-control">
                    <div class="form-text" style="color:var(--text-faint);">JPG, PNG, WebP — máx. 2 MB.</div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.getElementById('image-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const wrap = document.getElementById('img-preview-wrap');
    const img  = document.getElementById('img-preview');
    img.src = URL.createObjectURL(file);
    wrap.classList.remove('d-none');
});
</script>
