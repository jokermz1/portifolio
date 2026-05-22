<?php
/**
 * Partial: Lista de comentários aprovados com respostas
 * Requer: $comments (array), $user, $csrf, $entityType, $entityId
 */
$typeBadge = [
    'comment'    => ['bg-secondary', 'bi-chat',          'Comentário'],
    'suggestion' => ['bg-info text-dark', 'bi-lightbulb','Sugestão'],
    'critique'   => ['bg-warning text-dark','bi-pencil-square','Crítica'],
];
?>
<div class="comments-section mt-5">
    <h4 class="mb-4 border-bottom border-secondary pb-2">
        <i class="bi bi-chat-square-dots me-2"></i>
        Comentários (<?= count($comments) ?>)
    </h4>

    <?php if (empty($comments)): ?>
        <p class="text-muted">Ainda não há comentários. Seja o primeiro!</p>
    <?php endif; ?>

    <?php foreach ($comments as $c): ?>
    <div class="comment-item mb-4 p-3 rounded border border-secondary bg-dark bg-opacity-50" id="comment-<?= $c['id'] ?>">
        <div class="d-flex align-items-start gap-3">
            <div class="flex-shrink-0">
                <?php if ($c['user_avatar']): ?>
                    <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($c['user_avatar']) ?>"
                         class="rounded-circle" width="42" height="42" alt="">
                <?php else: ?>
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                         style="width:42px;height:42px;">
                        <i class="bi bi-person text-white"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                    <strong class="text-white"><?= htmlspecialchars($c['user_name']) ?></strong>
                    <?php [$badgeClass, $icon, $label] = $typeBadge[$c['type']] ?? $typeBadge['comment']; ?>
                    <span class="badge <?= $badgeClass ?>"><i class="bi <?= $icon ?> me-1"></i><?= $label ?></span>
                    <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>
                        <?= date('d/m/Y H:i', strtotime($c['published_at'] ?? $c['created_at'])) ?>
                    </small>
                    <?php if ($c['is_edited']): ?>
                        <small class="text-muted fst-italic">
                            <i class="bi bi-pencil me-1"></i>editado em <?= date('d/m/Y H:i', strtotime($c['edited_at'])) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <p class="mb-2 text-light"><?= nl2br(htmlspecialchars($c['content'])) ?></p>

                <div class="d-flex gap-2 flex-wrap">
                    <?php if (isset($user) && $user): ?>
                        <!-- Botão responder -->
                        <button class="btn btn-sm btn-outline-secondary reply-toggle" data-id="<?= $c['id'] ?>">
                            <i class="bi bi-reply me-1"></i>Responder
                        </button>
                        <?php if ((int)($user['id'] ?? 0) === (int)$c['user_id']): ?>
                            <!-- Editar -->
                            <button class="btn btn-sm btn-outline-warning edit-toggle" data-id="<?= $c['id'] ?>">
                                <i class="bi bi-pencil me-1"></i>Editar
                            </button>
                            <!-- Apagar -->
                            <form method="POST" action="<?= BASE_URL ?>/comments/<?= $c['id'] ?>/delete"
                                  onsubmit="return confirm('Apagar este comentário?')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
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
                        <textarea class="form-control bg-dark text-white border-secondary mb-2" name="content"
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
        <div class="replies ms-5 mt-3 border-start border-secondary ps-3">
            <?php foreach ($c['replies'] as $r): ?>
            <div class="comment-item mb-3 p-2 rounded border border-secondary bg-dark bg-opacity-25" id="comment-<?= $r['id'] ?>">
                <div class="d-flex align-items-start gap-2">
                    <div class="flex-shrink-0">
                        <?php if ($r['user_avatar']): ?>
                            <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($r['user_avatar']) ?>"
                                 class="rounded-circle" width="32" height="32" alt="">
                        <?php else: ?>
                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:32px;height:32px;">
                                <i class="bi bi-person text-white small"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                            <strong class="text-white small"><?= htmlspecialchars($r['user_name']) ?></strong>
                            <small class="text-muted">
                                <?= date('d/m/Y H:i', strtotime($r['published_at'] ?? $r['created_at'])) ?>
                            </small>
                            <?php if ($r['is_edited']): ?>
                                <small class="text-muted fst-italic">editado em <?= date('d/m/Y H:i', strtotime($r['edited_at'])) ?></small>
                            <?php endif; ?>
                        </div>
                        <p class="mb-1 text-light small"><?= nl2br(htmlspecialchars($r['content'])) ?></p>
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
