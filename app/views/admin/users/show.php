<?php $pageTitle = 'Utilizador — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= htmlspecialchars($user['name']) ?></h1>
        <span style="font-size:12px; color:var(--text-faint);">
            <?= t('Membro desde') ?> <?= date('d/m/Y', strtotime($user['created_at'])) ?>
        </span>
    </div>
    <a href="<?= BASE_URL ?>/admin/users" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i><?= t('Voltar') ?>
    </a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card text-center p-4">
            <?php if ($user['avatar']): ?>
                <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($user['avatar']) ?>"
                     class="rounded-circle mx-auto mb-3"
                     width="80" height="80" style="object-fit:cover;" alt="">
            <?php else: ?>
                <div class="avatar-placeholder rounded-circle mx-auto mb-3"
                     style="width:80px;height:80px;font-size:28px;">
                    <i class="bi bi-person"></i>
                </div>
            <?php endif; ?>
            <h5 class="mb-1"><?= htmlspecialchars($user['name']) ?></h5>
            <p style="color:var(--text-muted); font-size:13px; margin-bottom:4px;"><?= htmlspecialchars($user['email']) ?></p>
            <p style="color:var(--text-muted); font-size:12px;"><?= htmlspecialchars($user['bio'] ?? '—') ?></p>
            <hr>
            <div class="d-flex justify-content-between" style="font-size:12px; color:var(--text-muted);">
                <span><?= t('Estado') ?></span>
                <span class="badge bg-<?= $user['is_active'] ? 'success' : 'danger' ?>">
                    <?= $user['is_active'] ? t('Ativo') : t('Suspenso') ?>
                </span>
            </div>
            <form method="POST" action="<?= BASE_URL ?>/admin/users/<?= $user['id'] ?>/toggle" class="mt-3"
                  onsubmit="return confirm('<?= e_t('Confirmar?') ?>')">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                <button class="btn btn-sm <?= $user['is_active'] ? 'btn-outline-danger' : 'btn-outline-secondary' ?> w-100">
                    <?= $user['is_active'] ? t('Suspender utilizador') : t('Reativar utilizador') ?>
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-chat-dots" style="color:#fbbf24;"></i>
                <?= t('Histórico de Comentários') ?>
                <span class="badge ms-1" style="background:rgba(255,255,255,.08); color:var(--text-muted);"><?= count($comments) ?></span>
            </div>
            <div class="card-body p-0">
                <?php if (empty($comments)): ?>
                    <div class="empty-state">
                        <i class="bi bi-chat"></i>
                        <p><?= t('Nenhum comentário ainda.') ?></p>
                    </div>
                <?php else: ?>
                <div class="list-group list-group-flush">
                    <?php
                    $statusColor = ['pending'=>'warning','approved'=>'success','rejected'=>'danger'];
                    $typeColor   = ['comment'=>'secondary','suggestion'=>'info','critique'=>'warning'];
                    foreach ($comments as $c): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div class="d-flex gap-1 flex-wrap">
                                <span class="badge bg-<?= $typeColor[$c['type']] ?? 'secondary' ?>"><?= $c['type'] ?></span>
                                <span class="badge bg-<?= $statusColor[$c['status']] ?? 'secondary' ?>"><?= $c['status'] ?></span>
                                <span style="color:var(--text-muted); font-size:11px; margin-left:4px;"><?= $c['entity_type'] ?> #<?= $c['entity_id'] ?></span>
                            </div>
                            <small style="color:var(--text-faint);"><?= date('d/m/Y', strtotime($c['created_at'])) ?></small>
                        </div>
                        <p style="font-size:12px; margin:0 0 4px;"><?= htmlspecialchars(mb_substr($c['content'], 0, 120)) ?></p>
                        <small style="color:var(--text-faint); font-family:monospace;">IP: <?= htmlspecialchars($c['ip_address']) ?></small>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
