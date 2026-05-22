<?php $pageTitle = 'Mensagem — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title">Mensagem</h1>
        <span style="font-size:12px; color:var(--text-faint);">
            <?= date('d/m/Y \à\s H:i', strtotime($message['created_at'])) ?>
        </span>
    </div>
    <a href="<?= BASE_URL ?>/admin/messages" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><?= htmlspecialchars($message['subject'] ?? '(sem assunto)') ?></span>
                <?php if ($message['is_read']): ?>
                <span class="badge" style="background:rgba(255,255,255,.06); color:var(--text-muted);">Lida</span>
                <?php else: ?>
                <span class="badge" style="background:var(--accent-dim); color:var(--accent); border:1px solid var(--accent-glow);">Nova</span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <p style="white-space:pre-wrap; line-height:1.8; color:var(--text-primary);">
                    <?= htmlspecialchars($message['message']) ?>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header">
                <span class="section-label mb-0">Remetente</span>
            </div>
            <div class="card-body">
                <p class="fw-semibold mb-1"><?= htmlspecialchars($message['name']) ?></p>
                <p style="color:var(--text-muted); margin-bottom:6px;">
                    <i class="bi bi-envelope me-1"></i>
                    <a href="mailto:<?= htmlspecialchars($message['email']) ?>" style="color:var(--accent);">
                        <?= htmlspecialchars($message['email']) ?>
                    </a>
                </p>
                <?php if (!empty($message['phone'])): ?>
                <p style="color:var(--text-muted); margin:0;">
                    <i class="bi bi-telephone me-1"></i>
                    <?= htmlspecialchars($message['phone']) ?>
                </p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <p style="color:var(--text-muted); font-size:12px; margin:0;">
                    <i class="bi bi-calendar3 me-1"></i>
                    Recebida em <?= date('d/m/Y \à\s H:i', strtotime($message['created_at'])) ?>
                </p>
            </div>
        </div>

        <a href="mailto:<?= htmlspecialchars($message['email']) ?>?subject=Re: <?= rawurlencode($message['subject'] ?? '') ?>"
           class="btn btn-primary btn-sm w-100">
            <i class="bi bi-reply me-1"></i>Responder por e-mail
        </a>
    </div>
</div>
