<?php $pageTitle = 'Novo Projeto — Admin'; ?>
<div class="page-header">
    <h1 class="page-title">Novo Projeto</h1>
    <a href="<?= BASE_URL ?>/admin/portfolio" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/portfolio/create" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">
        <!-- ── Coluna principal ── -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-folder2 me-2" style="color:var(--accent);"></i>Informações do Projeto</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Título *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Categoria</label>
                            <input type="text" name="category" list="cat-list" class="form-control" placeholder="ex: Web Design">
                            <datalist id="cat-list">
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descrição curta</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Conteúdo</label>
                            <textarea name="content" class="form-control" rows="6"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- URLs -->
            <?php $existingLinks = []; View::partial('links-manager', ['existingLinks' => $existingLinks]); ?>

            <!-- Galeria de imagens -->
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-images me-2" style="color:var(--accent);"></i>Galeria de Imagens</div>
                <div class="card-body">
                    <p style="font-size:12px; color:var(--text-muted); margin-bottom:12px;">Podes seleccionar várias imagens de uma vez. A primeira imagem do formulário acima é a capa.</p>
                    <label class="form-label">Imagem de Capa</label>
                    <input type="file" name="image" class="form-control mb-3" accept="image/*" id="cover-input">
                    <div id="cover-preview" class="mb-3" style="display:none;">
                        <img id="cover-img" src="" alt="" style="height:120px; border-radius:8px; object-fit:cover; border:1px solid rgba(183,117,255,.2);">
                    </div>

                    <label class="form-label">Imagens Adicionais <small style="color:var(--text-faint); font-weight:400;">(multi-selecção)</small></label>
                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple id="gallery-input">
                    <div id="gallery-preview" class="d-flex flex-wrap gap-2 mt-3"></div>
                </div>
            </div>
        </div>

        <!-- ── Coluna lateral ── -->
        <div class="col-lg-4">
            <div class="card mb-4" style="position:sticky; top:20px;">
                <div class="card-header"><i class="bi bi-gear me-2" style="color:var(--accent);"></i>Publicação</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" checked>
                        <label class="form-check-label" for="is_published">Publicado</label>
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured">
                        <label class="form-check-label" for="is_featured">Destacado na homepage</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i>Criar Projeto
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
