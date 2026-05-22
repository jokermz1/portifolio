<?php $pageTitle = 'Novo Projeto — Admin'; ?>
<div class="page-header">
    <h1 class="page-title">Novo Projeto</h1>
    <a href="<?= BASE_URL ?>/admin/portfolio" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/portfolio/create" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Título *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Categoria</label>
                    <input type="text" name="category" list="cat-list"
                           class="form-control"
                           placeholder="ex: Web Design, Branding, Logo">
                    <datalist id="cat-list">
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>">
                        <?php endforeach; ?>
                    </datalist>
                    <small style="color:var(--text-faint); font-size:11px;">Escolhe uma existente ou cria nova.</small>
                </div>
                <div class="col-12">
                    <label class="form-label">Descrição curta</label>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Conteúdo</label>
                    <textarea name="content" class="form-control" rows="6"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">URL do Projeto</label>
                    <input type="url" name="project_url" class="form-control" placeholder="https://...">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Imagem</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" checked>
                        <label class="form-check-label" for="is_published">Publicado</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured">
                        <label class="form-check-label" for="is_featured">Destacado na homepage</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Criar Projeto
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
