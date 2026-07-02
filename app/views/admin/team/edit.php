<?php $pageTitle = 'Editar Membro — Admin'; ?>
<div class="page-header">
    <h1 class="page-title"><?= t('Editar Membro') ?></h1>
    <a href="<?= BASE_URL ?>/admin/team" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i><?= t('Voltar') ?>
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/team/<?= $member['id'] ?>/edit" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label"><?= t('Nome') ?> *</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($member['name']) ?>"
                           class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?= t('Função / Cargo') ?></label>
                    <input type="text" name="role" value="<?= htmlspecialchars($member['role'] ?? '') ?>"
                           class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label"><?= t('Bio') ?></label>
                    <textarea name="bio" class="form-control"
                              rows="3"><?= htmlspecialchars($member['bio'] ?? '') ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        <?= t('Nova Foto') ?>
                        <small style="color:var(--text-muted); font-weight:400;"><?= t('(deixe vazio para manter)') ?></small>
                    </label>
                    <input type="file" name="photo" accept="image/*" class="form-control">
                    <?php if (!empty($member['photo'])): ?>
                    <div class="mt-2">
                        <img src="<?= UPLOAD_URL ?>team/<?= htmlspecialchars($member['photo']) ?>"
                             height="56" class="rounded-circle" alt="">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-3">
                    <label class="form-label"><?= t('Ordem') ?></label>
                    <input type="number" name="sort_order" value="<?= (int)$member['sort_order'] ?>"
                           class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                               id="is_active" <?= $member['is_active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active"><?= t('Ativo') ?></label>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                    <p class="section-label"><?= t('Redes Sociais') ?></p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Facebook</label>
                    <input type="url" name="social_facebook" value="<?= htmlspecialchars($member['social_facebook'] ?? '') ?>"
                           class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Twitter / X</label>
                    <input type="url" name="social_twitter" value="<?= htmlspecialchars($member['social_twitter'] ?? '') ?>"
                           class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Instagram</label>
                    <input type="url" name="social_instagram" value="<?= htmlspecialchars($member['social_instagram'] ?? '') ?>"
                           class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">LinkedIn</label>
                    <input type="url" name="social_linkedin" value="<?= htmlspecialchars($member['social_linkedin'] ?? '') ?>"
                           class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">YouTube</label>
                    <input type="url" name="social_youtube" value="<?= htmlspecialchars($member['social_youtube'] ?? '') ?>"
                           class="form-control">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i><?= t('Guardar Alterações') ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
