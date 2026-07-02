<?php $pageTitle = 'Novo Membro — Admin'; ?>
<div class="page-header">
    <h1 class="page-title"><?= t('Novo Membro') ?></h1>
    <a href="<?= BASE_URL ?>/admin/team" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i><?= t('Voltar') ?>
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/team/create" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label"><?= t('Nome') ?> *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?= t('Função / Cargo') ?></label>
                    <input type="text" name="role" class="form-control"
                           placeholder="ex: Designer, Developer, Advisor">
                </div>
                <div class="col-12">
                    <label class="form-label"><?= t('Bio') ?></label>
                    <textarea name="bio" class="form-control"
                              rows="3" placeholder="<?= e_t('Breve descrição...') ?>"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?= t('Foto') ?></label>
                    <input type="file" name="photo" accept="image/*" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label"><?= t('Ordem') ?></label>
                    <input type="number" name="sort_order" value="0" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                               id="is_active" checked>
                        <label class="form-check-label" for="is_active"><?= t('Ativo') ?></label>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                    <p class="section-label"><?= t('Redes Sociais') ?></p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Facebook</label>
                    <input type="url" name="social_facebook" class="form-control"
                           placeholder="https://facebook.com/...">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Twitter / X</label>
                    <input type="url" name="social_twitter" class="form-control"
                           placeholder="https://twitter.com/...">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Instagram</label>
                    <input type="url" name="social_instagram" class="form-control"
                           placeholder="https://instagram.com/...">
                </div>
                <div class="col-md-6">
                    <label class="form-label">LinkedIn</label>
                    <input type="url" name="social_linkedin" class="form-control"
                           placeholder="https://linkedin.com/in/...">
                </div>
                <div class="col-md-6">
                    <label class="form-label">YouTube</label>
                    <input type="url" name="social_youtube" class="form-control"
                           placeholder="https://youtube.com/...">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i><?= t('Criar Membro') ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
