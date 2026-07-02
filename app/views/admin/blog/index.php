<?php $pageTitle = 'Blog — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= t('Blog') ?></h1>
        <span style="font-size:12px; color:var(--text-faint);"><?= count($posts) ?> <?= t('Posts') ?></span>
    </div>
    <a href="<?= BASE_URL ?>/admin/blog/create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle me-1"></i><?= t('Novo Post') ?>
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:60px;"><?= t('Imagem') ?></th>
                        <th><?= t('Título') ?></th>
                        <th><?= t('Estado') ?></th>
                        <th><?= t('Data') ?></th>
                        <th><?= t('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $p): ?>
                    <tr>
                        <td class="py-2">
                            <?php if (!empty($p['image'])): ?>
                            <img src="<?= UPLOAD_URL ?>posts/<?= htmlspecialchars($p['image']) ?>"
                                 alt="" style="width:48px;height:36px;object-fit:cover;border-radius:6px;">
                            <?php else: ?>
                            <div class="avatar-placeholder rounded" style="width:48px;height:36px;">
                                <i class="bi bi-image" style="font-size:13px;"></i>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <p class="mb-0 fw-semibold"><?= htmlspecialchars($p['title']) ?></p>
                            <?php if (!empty($p['excerpt'])): ?>
                            <small style="color:var(--text-muted);"><?= htmlspecialchars(mb_strimwidth($p['excerpt'], 0, 60, '…')) ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?= $p['is_published'] ? 'success' : 'secondary' ?>">
                                <?= $p['is_published'] ? t('Publicado') : t('Rascunho') ?>
                            </span>
                        </td>
                        <td style="white-space:nowrap; color:var(--text-muted);">
                            <?php if ($p['published_at']): ?>
                                <?= date('d/m/Y', strtotime($p['published_at'])) ?>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/blog/<?= $p['id'] ?>/edit"
                               class="btn btn-sm btn-outline-primary" title="<?= e_t('Editar') ?>">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= BASE_URL ?>/blog/<?= htmlspecialchars($p['slug']) ?>"
                               target="_blank" class="btn btn-sm btn-outline-secondary" title="<?= e_t('Ver no site') ?>">
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                            <form method="POST" action="<?= BASE_URL ?>/admin/blog/<?= $p['id'] ?>/delete"
                                  class="d-inline" onsubmit="return confirm('<?= e_t('Apagar este post?') ?>')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-danger" title="<?= e_t('Apagar') ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($posts)): ?>
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-file-earmark-text"></i>
                            <p><?= t('Nenhum post criado ainda.') ?></p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
