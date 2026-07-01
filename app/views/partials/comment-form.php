<?php
/**
 * Partial: Formulário de comentário/sugestão/crítica
 * Requer: $entityType, $entityId, $csrf, $user, $parentId (opcional)
 */
$parentId = $parentId ?? null;
?>
<?php if (empty($GLOBALS['__cmt_form_css'])): $GLOBALS['__cmt_form_css'] = true; ?>
<style>
/* ═══ Formulário de comentário ═══════════════════════════════ */
.comment-form .cmt-form-title { color: #ffffff; font-weight: 600; }
.comment-form .form-label { color: #d9d2e8; }
.comment-form .form-check-label { color: #cfc8de; cursor: pointer; }
.comment-form .form-check-label i { color: #b775ff; }
.comment-form .form-check-input:checked {
    background-color: #8F3AEC;
    border-color: #8F3AEC;
}

.comment-form textarea.form-control {
    background: rgba(15, 14, 16, .6);
    color: #f1eef8;
    border: 1px solid rgba(183, 117, 255, .28);
}
.comment-form textarea.form-control::placeholder { color: #8f86a3; }
.comment-form textarea.form-control:focus {
    background: rgba(15, 14, 16, .8);
    color: #fff;
    border-color: #8F3AEC;
    box-shadow: 0 0 0 .2rem rgba(143, 58, 236, .25);
}
.comment-form .cmt-hint { color: #a99fbb; }

/* Caixa "Inicie sessão para comentar" */
.cmt-login-box {
    background: rgba(143, 58, 236, .08);
    border: 1px solid rgba(183, 117, 255, .28);
    border-radius: 14px;
    color: #d9d2e8;
    padding: 1.1rem 1.25rem;
}
.cmt-login-box i { color: #b775ff; }
.cmt-login-box a {
    color: #c9a7ff;
    font-weight: 600;
    text-decoration: none;
}
.cmt-login-box a:hover { text-decoration: underline; }
</style>
<?php endif; ?>
<?php if ($user): ?>
<div class="comment-form mt-4">
    <h5 class="cmt-form-title mb-3"><?= $parentId ? 'Responder' : 'Deixar um comentário' ?></h5>
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
            <div class="d-flex gap-3 flex-wrap">
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
            <textarea class="form-control" name="content" rows="4"
                      placeholder="Escreva aqui..." required minlength="5"></textarea>
        </div>
        <div class="d-flex align-items-center flex-wrap gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send me-1"></i> Publicar
            </button>
            <small class="cmt-hint">
                <i class="bi bi-clock me-1"></i>Aguarda moderação antes de ser publicado.
            </small>
        </div>
    </form>
</div>
<?php else: ?>
<div class="cmt-login-box mt-4">
    <i class="bi bi-lock me-2"></i>
    <a href="<?= BASE_URL ?>/login">Inicie sessão</a> ou
    <a href="<?= BASE_URL ?>/register">registe-se</a> para comentar.
</div>
<?php endif; ?>
