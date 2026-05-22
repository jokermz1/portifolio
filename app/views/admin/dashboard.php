<?php $pageTitle = 'Dashboard — Admin'; ?>

<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <span style="font-size:12px; color: var(--text-faint);">Visão geral do painel</span>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <?php
    $cards = [
        ['projects',         'Projetos',     'bi-folder2-open', 'purple', '/admin/portfolio'],
        ['posts',            'Posts',        'bi-journal-text', 'blue',   '/admin/blog'],
        ['users',            'Utilizadores', 'bi-people',       'green',  '/admin/users'],
        ['messages_unread',  'Mensagens',    'bi-envelope',     'amber',  '/admin/messages'],
        ['comments_pending', 'Pendentes',    'bi-chat-dots',    'red',    '/admin/comments/pending'],
    ];
    foreach ($cards as [$key, $label, $icon, $color, $link]): ?>
    <div class="col-6 col-lg-4 col-xl">
        <a href="<?= BASE_URL . $link ?>" class="stat-card">
            <div class="stat-icon stat-icon-<?= $color ?>">
                <i class="bi <?= $icon ?>"></i>
            </div>
            <div>
                <div class="stat-value"><?= $stats[$key] ?? 0 ?></div>
                <div class="stat-label"><?= $label ?></div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<!-- Bottom panels -->
<div class="row g-4">
    <!-- Comentários pendentes -->
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-chat-dots me-2" style="color:#fbbf24;"></i>Comentários Pendentes</span>
                <a href="<?= BASE_URL ?>/admin/comments/pending" class="btn btn-outline-warning btn-sm">Ver todos</a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($pendingComments)): ?>
                    <p class="p-4 mb-0" style="color: var(--text-muted); font-size:13px;">Nenhum comentário pendente.</p>
                <?php else: ?>
                <div class="list-group list-group-flush">
                    <?php foreach (array_slice($pendingComments, 0, 5) as $c): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div style="min-width:0;">
                            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                <strong style="font-size:12px;"><?= htmlspecialchars($c['user_name']) ?></strong>
                                <span class="badge" style="background:rgba(255,255,255,.08); color:var(--text-muted);"><?= $c['entity_type'] ?> #<?= $c['entity_id'] ?></span>
                            </div>
                            <p style="font-size:12px; color:var(--text-muted); margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:340px;">
                                <?= htmlspecialchars(mb_substr($c['content'], 0, 90)) ?>…
                            </p>
                        </div>
                        <div class="d-flex gap-1 ms-2 flex-shrink-0">
                            <form method="POST" action="<?= BASE_URL ?>/admin/comments/<?= $c['id'] ?>/approve">
                                <input type="hidden" name="_csrf" value="<?= $this->csrfToken() ?? '' ?>">
                                <button class="btn btn-sm btn-success" title="Aprovar"><i class="bi bi-check"></i></button>
                            </form>
                            <form method="POST" action="<?= BASE_URL ?>/admin/comments/<?= $c['id'] ?>/reject">
                                <input type="hidden" name="_csrf" value="<?= $this->csrfToken() ?? '' ?>">
                                <button class="btn btn-sm btn-danger" title="Rejeitar"><i class="bi bi-x"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Mensagens não lidas -->
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-envelope me-2" style="color:#f87171;"></i>Mensagens Não Lidas</span>
                <a href="<?= BASE_URL ?>/admin/messages" class="btn btn-outline-danger btn-sm">Ver todas</a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($unreadMessages)): ?>
                    <p class="p-4 mb-0" style="color: var(--text-muted); font-size:13px;">Nenhuma mensagem não lida.</p>
                <?php else: ?>
                <div class="list-group list-group-flush">
                    <?php foreach (array_slice($unreadMessages, 0, 5) as $m): ?>
                    <a href="<?= BASE_URL ?>/admin/messages/<?= $m['id'] ?>"
                       class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-start">
                            <strong style="font-size:12px;"><?= htmlspecialchars($m['name']) ?></strong>
                            <small style="color:var(--text-faint); font-size:11px; flex-shrink:0; margin-left:8px;"><?= date('d/m', strtotime($m['created_at'])) ?></small>
                        </div>
                        <p style="font-size:12px; color:var(--text-muted); margin:2px 0 0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            <?= htmlspecialchars(mb_substr($m['subject'] ?? $m['content'], 0, 55)) ?>…
                        </p>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
