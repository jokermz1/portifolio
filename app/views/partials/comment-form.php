<?php
/**
 * Partial: Formulário de comentário/sugestão/crítica
 * Requer: $entityType, $entityId, $csrf, $user, $parentId (opcional)
 */
$parentId = $parentId ?? null;
?>
<?php if ($user): ?>
<div class="comment-form mt-4">
    <h5 class="mb-3"><?= $parentId ? 'Responder' : 'Deixar um comentário' ?></h5>
    <form method="POST" action="<?= BASE_URL ?>/comments">
        <input type="hidden" name="_csrf"        value="<?= htmlspecialchars($csrf) ?>">
        <input type="hidden" name="entity_type"  value="<?= htmlspecialchars($entityType) ?>">
        <input type="hidden" name="entity_id"    value="<?= (int) $entityId ?>">
        <?php if ($parentId): ?>
            <input type="hidden" name="parent_id" value="<?= (int) $parentId ?>">
        <?php endif; ?>

        <?php if (!$parentId): ?>
        <div class="mb-3">
            <label class="form-label fw-semibold">Tipo</label>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" value="comment" id="type_comment" checked>
                    <label class="form-check-label" for="type_comment">
                        <i class="bi bi-chat me-1"></i> Comentário
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" value="suggestion" id="type_suggestion">
                    <label class="form-check-label" for="type_suggestion">
                        <i class="bi bi-lightbulb me-1"></i> Sugestão
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" value="critique" id="type_critique">
                    <label class="form-check-label" for="type_critique">
                        <i class="bi bi-pencil-square me-1"></i> Crítica
                    </label>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="mb-3">
            <textarea class="form-control bg-dark text-white border-secondary" name="content" rows="4"
                      placeholder="Escreva aqui..." required minlength="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-send me-1"></i> Publicar
        </button>
        <small class="text-muted ms-3">
            <i class="bi bi-clock me-1"></i>Aguarda moderação antes de ser publicado.
        </small>
    </form>
</div>
<?php else: ?>
<div class="alert alert-dark border border-secondary mt-4">
    <i class="bi bi-lock me-2"></i>
    <a href="<?= BASE_URL ?>/login" class="text-primary">Inicie sessão</a> ou
    <a href="<?= BASE_URL ?>/register" class="text-primary">registe-se</a> para comentar.
</div>
<?php endif; ?>
