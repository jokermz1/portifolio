<?php
/**
 * Partial: Lista de comentários aprovados com respostas
 * Requer: $comments (array), $user, $csrf, $entityType, $entityId
 */
$typeBadge = [
    'comment'    => ['cmt-badge cmt-badge-comment',    'bi-chat',          'Comentário'],
    'suggestion' => ['cmt-badge cmt-badge-suggestion', 'bi-lightbulb',     'Sugestão'],
    'critique'   => ['cmt-badge cmt-badge-critique',   'bi-pencil-square', 'Crítica'],
];
?>
<style>
/* ═══ Secção de comentários ══════════════════════════════════ */
.comments-section { color: #e8e4f0; }

.comments-section .cmt-title {
    color: #ffffff;
    font-weight: 600;
    letter-spacing: .01em;
    border-bottom: 1px solid rgba(183, 117, 255, .28);
    padding-bottom: .6rem;
}
.comments-section .cmt-title i { color: #b775ff; }
.comments-section .cmt-count {
    color: #b775ff;
    font-weight: 600;
}

.comments-section .cmt-empty {
    color: #a99fbb;
    background: rgba(183, 117, 255, .05);
    border: 1px dashed rgba(183, 117, 255, .22);
    border-radius: 12px;
    padding: 1.1rem 1.25rem;
}

/* ── Cartão de comentário ─────────────────────────────────── */
.comments-section .cmt-item {
    background: rgba(143, 58, 236, .07);
    border: 1px solid rgba(183, 117, 255, .18);
    border-radius: 14px;
    transition: border-color .2s ease, background .2s ease;
}
.comments-section .cmt-item:hover {
    border-color: rgba(183, 117, 255, .40);
    background: rgba(143, 58, 236, .11);
}
.comments-section .cmt-item.cmt-reply {
    background: rgba(255, 255, 255, .035);
    border-color: rgba(183, 117, 255, .14);
}

.comments-section .cmt-author {
    color: #ffffff;
    font-weight: 600;
}
.comments-section .cmt-meta {
    color: #b1a7c4;   /* muted mas legível */
    font-size: .8rem;
}
.comments-section .cmt-meta i { opacity: .8; }
.comments-section .cmt-body {
    color: #e8e4f0;
    line-height: 1.55;
}

/* ── Avatar fallback ──────────────────────────────────────── */
.comments-section .cmt-avatar {
    background: linear-gradient(135deg, #7710E9, #8F3AEC);
    color: #fff;
}
.comments-section .cmt-avatar-img {
    object-fit: cover;
    border: 1px solid rgba(183, 117, 255, .35);
}

/* ── Badges por tipo ──────────────────────────────────────── */
.comments-section .cmt-badge {
    display: inline-flex;
    align-items: center;
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .02em;
    padding: .28em .62em;
    border-radius: 999px;
    border: 1px solid transparent;
    line-height: 1;
}
.comments-section .cmt-badge-comment    { background: rgba(183, 117, 255, .16); color: #cbaaff; border-color: rgba(183, 117, 255, .40); }
.comments-section .cmt-badge-suggestion { background: rgba(56, 189, 248, .16);  color: #7dd3fc; border-color: rgba(56, 189, 248, .42); }
.comments-section .cmt-badge-critique   { background: rgba(251, 191, 36, .16);  color: #fcd34d; border-color: rgba(251, 191, 36, .45); }

/* ── Botões de ação ───────────────────────────────────────── */
.comments-section .cmt-action {
    font-size: .8rem;
    padding: .25rem .7rem;
    border-radius: 999px;
}

/* ── Formulários (editar / responder) ─────────────────────── */
.comments-section textarea.form-control {
    background: rgba(15, 14, 16, .6);
    color: #f1eef8;
    border: 1px solid rgba(183, 117, 255, .28);
}
.comments-section textarea.form-control::placeholder { color: #8f86a3; }
.comments-section textarea.form-control:focus {
    background: rgba(15, 14, 16, .8);
    color: #fff;
    border-color: #8F3AEC;
    box-shadow: 0 0 0 .2rem rgba(143, 58, 236, .25);
}
</style>

<div class="comments-section mt-5">
    <h4 class="cmt-title mb-4">
        <i class="bi bi-chat-square-dots me-2"></i>
        Comentários <span class="cmt-count">(<?= count($comments) ?>)</span>
    </h4>

    <?php if (empty($comments)): ?>
        <p class="cmt-empty">
            <i class="bi bi-chat-dots me-2"></i>Ainda não há comentários. Seja o primeiro!
        </p>
    <?php endif; ?>

    <?php foreach ($comments as $c): ?>
    <div class="cmt-item mb-4 p-3" id="comment-<?= $c['id'] ?>">
        <div class="d-flex align-items-start gap-3">
            <div class="flex-shrink-0">
                <?php if ($c['user_avatar']): ?>
                    <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($c['user_avatar']) ?>"
                         class="rounded-circle cmt-avatar-img" width="42" height="42" alt="">
                <?php else: ?>
                    <div class="cmt-avatar rounded-circle d-flex align-items-center justify-content-center"
                         style="width:42px;height:42px;">
                        <i class="bi bi-person"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                    <strong class="cmt-author"><?= htmlspecialchars($c['user_name']) ?></strong>
                    <?php [$badgeClass, $icon, $label] = $typeBadge[$c['type']] ?? $typeBadge['comment']; ?>
                    <span class="<?= $badgeClass ?>"><i class="bi <?= $icon ?> me-1"></i><?= $label ?></span>
                    <small class="cmt-meta">
                        <i class="bi bi-clock me-1"></i>
                        <?= date('d/m/Y H:i', strtotime($c['published_at'] ?? $c['created_at'])) ?>
                    </small>
                    <?php if ($c['is_edited']): ?>
                        <small class="cmt-meta fst-italic">
                            <i class="bi bi-pencil me-1"></i>editado em <?= date('d/m/Y H:i', strtotime($c['edited_at'])) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <p class="cmt-body mb-2"><?= nl2br(htmlspecialchars($c['content'])) ?></p>

                <div class="d-flex gap-2 flex-wrap">
                    <?php if (isset($user) && $user): ?>
                        <!-- Botão responder -->
                        <button class="btn btn-sm btn-outline-light cmt-action reply-toggle" data-id="<?= $c['id'] ?>">
                            <i class="bi bi-reply me-1"></i>Responder
                        </button>
                        <?php if ((int)($user['id'] ?? 0) === (int)$c['user_id']): ?>
                            <!-- Editar -->
                            <button class="btn btn-sm btn-outline-warning cmt-action edit-toggle" data-id="<?= $c['id'] ?>">
                                <i class="bi bi-pencil me-1"></i>Editar
                            </button>
                            <!-- Apagar -->
                            <form method="POST" action="<?= BASE_URL ?>/comments/<?= $c['id'] ?>/delete"
                                  onsubmit="return confirm('Apagar este comentário?')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger cmt-action">
                                    <i class="bi bi-trash me-1"></i>Apagar
                                </button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Form de edição (oculto) -->
                <?php if (isset($user) && $user && (int)($user['id'] ?? 0) === (int)$c['user_id']): ?>
                <div class="edit-form mt-2 d-none" id="edit-<?= $c['id'] ?>">
                    <form method="POST" action="<?= BASE_URL ?>/comments/<?= $c['id'] ?>/edit">
                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                        <textarea class="form-control mb-2" name="content"
                                  rows="3" required><?= htmlspecialchars($c['content']) ?></textarea>
                        <button type="submit" class="btn btn-sm btn-warning">
                            <i class="bi bi-check me-1"></i>Guardar
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary cancel-edit" data-id="<?= $c['id'] ?>">
                            Cancelar
                        </button>
                    </form>
                </div>
                <?php endif; ?>

                <!-- Form de resposta (oculto) -->
                <?php if (isset($user) && $user): ?>
                <div class="reply-form mt-2 d-none" id="reply-<?= $c['id'] ?>">
                    <?php View::partial('comment-form', [
                        'entityType' => $entityType,
                        'entityId'   => $entityId,
                        'csrf'       => $csrf,
                        'user'       => $user,
                        'parentId'   => $c['id'],
                    ]); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Respostas -->
        <?php if (!empty($c['replies'])): ?>
        <div class="replies ms-5 mt-3 ps-3" style="border-left:2px solid rgba(183,117,255,.25);">
            <?php foreach ($c['replies'] as $r): ?>
            <div class="cmt-item cmt-reply mb-3 p-2" id="comment-<?= $r['id'] ?>">
                <div class="d-flex align-items-start gap-2">
                    <div class="flex-shrink-0">
                        <?php if ($r['user_avatar']): ?>
                            <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($r['user_avatar']) ?>"
                                 class="rounded-circle cmt-avatar-img" width="32" height="32" alt="">
                        <?php else: ?>
                            <div class="cmt-avatar rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:32px;height:32px;">
                                <i class="bi bi-person small"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                            <strong class="cmt-author small"><?= htmlspecialchars($r['user_name']) ?></strong>
                            <small class="cmt-meta">
                                <i class="bi bi-clock me-1"></i>
                                <?= date('d/m/Y H:i', strtotime($r['published_at'] ?? $r['created_at'])) ?>
                            </small>
                            <?php if ($r['is_edited']): ?>
                                <small class="cmt-meta fst-italic">editado em <?= date('d/m/Y H:i', strtotime($r['edited_at'])) ?></small>
                            <?php endif; ?>
                        </div>
                        <p class="cmt-body small mb-1"><?= nl2br(htmlspecialchars($r['content'])) ?></p>
                        <?php if (isset($user) && $user && (int)($user['id'] ?? 0) === (int)$r['user_id']): ?>
                        <form method="POST" action="<?= BASE_URL ?>/comments/<?= $r['id'] ?>/delete"
                              onsubmit="return confirm('Apagar?')" class="d-inline">
                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                            <button type="submit" class="btn btn-sm btn-link text-danger p-0">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>

<script>
document.querySelectorAll('.reply-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
        const el = document.getElementById('reply-' + btn.dataset.id);
        el.classList.toggle('d-none');
    });
});
document.querySelectorAll('.edit-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('edit-' + btn.dataset.id).classList.toggle('d-none');
    });
});
document.querySelectorAll('.cancel-edit').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('edit-' + btn.dataset.id).classList.add('d-none');
    });
});
</script>
