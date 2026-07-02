<?php $pageTitle = 'Comentários Pendentes — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= t('Moderação') ?></h1>
        <span style="font-size:12px; color:var(--text-faint);">
            <?php if (!empty($comments)): ?>
                <span style="color:#fbbf24;"><?= count($comments) ?> <?= t('Pendentes') ?></span>
            <?php else: ?>
                <?= t('Tudo em dia') ?>
            <?php endif; ?>
        </span>
    </div>
    <a href="<?= BASE_URL ?>/admin/comments/all" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-list me-1"></i><?= t('Ver todos') ?>
    </a>
</div>

<?php if (empty($comments)): ?>
    <div class="alert alert-success">
        <i class="bi bi-check-circle me-2"></i><?= t('Nenhum comentário pendente. Tudo em dia!') ?>
    </div>
<?php else: ?>
<div class="row g-3">
    <?php foreach ($comments as $c): ?>
    <?php
    $typeBadge  = ['comment'=>['secondary','bi-chat'],'suggestion'=>['info','bi-lightbulb'],'critique'=>['warning','bi-pencil-square']];
    [$bg, $icon] = $typeBadge[$c['type']] ?? $typeBadge['comment'];
    ?>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <strong><?= htmlspecialchars($c['user_name']) ?></strong>
                        <small style="color:var(--text-muted);"><?= htmlspecialchars($c['user_email']) ?></small>
                        <span class="badge bg-<?= $bg ?>">
                            <i class="bi <?= $icon ?> me-1"></i><?= $c['type'] ?>
                        </span>
                        <span class="badge" style="background:rgba(255,255,255,.06); color:var(--text-muted);">
                            <?= $c['entity_type'] ?> #<?= $c['entity_id'] ?>
                        </span>
                    </div>
                    <small style="color:var(--text-faint);">
                        <i class="bi bi-clock me-1"></i><?= date('d/m/Y H:i', strtotime($c['created_at'])) ?>
                    </small>
                </div>

                <blockquote class="blockquote ps-3 mb-3">
                    <p style="color:var(--text-primary); margin:0;"><?= nl2br(htmlspecialchars($c['content'])) ?></p>
                </blockquote>

                <div class="d-flex gap-2 align-items-center flex-wrap">
                    <form method="POST" action="<?= BASE_URL ?>/admin/comments/<?= $c['id'] ?>/approve">
                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="bi bi-check-circle me-1"></i><?= t('Aprovar') ?>
                        </button>
                    </form>
                    <form method="POST" action="<?= BASE_URL ?>/admin/comments/<?= $c['id'] ?>/reject">
                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                        <button type="submit" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-slash-circle me-1"></i><?= t('Rejeitar') ?>
                        </button>
                    </form>
                    <form method="POST" action="<?= BASE_URL ?>/admin/comments/<?= $c['id'] ?>/delete"
                          onsubmit="return confirm('<?= e_t('Apagar permanentemente?') ?>')">
                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash me-1"></i><?= t('Apagar') ?>
                        </button>
                    </form>
                    <small style="color:var(--text-faint); margin-left:auto;">
                        <i class="bi bi-geo-alt me-1"></i>IP: <?= htmlspecialchars($c['ip_address']) ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
