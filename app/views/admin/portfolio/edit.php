<?php $pageTitle = 'Editar Projeto — Admin'; ?>
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

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/portfolio/<?= $project['id'] ?>/edit" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Título *</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($project['title']) ?>"
                           class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Categoria</label>
                    <input type="text" name="category" list="cat-list"
                           value="<?= htmlspecialchars($project['category'] ?? '') ?>"
                           class="form-control"
                           placeholder="ex: Web Design, Branding, Logo">
                    <datalist id="cat-list">
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>">
                        <?php endforeach; ?>
                    </datalist>
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
                <div class="col-md-6">
                    <label class="form-label">URL do Projeto</label>
                    <input type="url" name="project_url" value="<?= htmlspecialchars($project['project_url'] ?? '') ?>"
                           class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        Nova Imagem
                        <small style="color:var(--text-muted); font-weight:400;">(deixe vazio para manter)</small>
                    </label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <?php if ($project['image']): ?>
                        <div class="mt-2">
                            <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($project['image']) ?>"
                                 height="40" style="border-radius:6px;" alt="">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1"
                               id="is_published" <?= $project['is_published'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_published">Publicado</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                               id="is_featured" <?= $project['is_featured'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_featured">Destacado na homepage</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Guardar Alterações
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
