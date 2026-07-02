<?php $pageTitle = 'FAQs — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= t('FAQs') ?></h1>
        <span style="font-size:12px; color:var(--text-faint);"><?= count($faqs) ?> <?= t('Perguntas') ?></span>
    </div>
    <a href="<?= BASE_URL ?>/admin/faqs/create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle me-1"></i><?= t('Nova FAQ') ?>
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th><?= t('Pergunta') ?></th>
                        <th style="width:80px;"><?= t('Ordem') ?></th>
                        <th style="width:90px;"><?= t('Estado') ?></th>
                        <th style="width:100px;"><?= t('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($faqs as $f): ?>
                    <tr>
                        <td style="color:var(--text-muted);"><?= (int)$f['id'] ?></td>
                        <td><?= htmlspecialchars($f['question']) ?></td>
                        <td style="color:var(--text-muted);"><?= (int)$f['sort_order'] ?></td>
                        <td>
                            <span class="badge bg-<?= $f['is_active'] ? 'success' : 'secondary' ?>">
                                <?= $f['is_active'] ? t('Ativa') : t('Inativa') ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/faqs/<?= $f['id'] ?>/edit"
                               class="btn btn-sm btn-outline-primary" title="<?= e_t('Editar') ?>"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= BASE_URL ?>/admin/faqs/<?= $f['id'] ?>/delete"
                                  class="d-inline" onsubmit="return confirm('<?= e_t('Apagar FAQ?') ?>')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-danger" title="<?= e_t('Apagar') ?>"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($faqs)): ?>
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-question-circle"></i>
                            <p><?= t('Nenhuma FAQ criada ainda.') ?></p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
