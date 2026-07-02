<?php $pageTitle = 'Nova FAQ — Admin'; ?>
<div class="page-header">
    <h1 class="page-title"><?= t('Nova FAQ') ?></h1>
    <a href="<?= BASE_URL ?>/admin/faqs" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i><?= t('Voltar') ?>
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/faqs/create">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label"><?= t('Pergunta') ?> *</label>
                    <input type="text" name="question" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label"><?= t('Resposta') ?> *</label>
                    <textarea name="answer" class="form-control" rows="5" required></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><?= t('Ordem') ?></label>
                    <input type="number" name="sort_order" value="0" class="form-control">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                        <label class="form-check-label" for="is_active"><?= t('Ativa') ?></label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i><?= t('Criar FAQ') ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
