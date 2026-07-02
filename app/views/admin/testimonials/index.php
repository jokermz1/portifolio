<?php
$pageTitle = 'Depoimentos — Admin';
if (!function_exists('starRow')) {
    function starRow(int $rating): string {
        $out = '';
        for ($i = 1; $i <= 5; $i++) {
            $out .= '<i class="bi bi-star' . ($i <= $rating ? '-fill' : '') . '" style="color:#fbbf24;font-size:13px;"></i>';
        }
        return $out;
    }
}
if (!function_exists('avatarTag')) {
    function avatarTag(array $t, int $size = 36): string {
        $name = $t['name'] ?? '?';
        if (!empty($t['user_avatar'])) {
            return '<img src="' . UPLOAD_URL . 'avatars/' . htmlspecialchars($t['user_avatar'])
                . '" alt="" style="width:' . $size . 'px;height:' . $size . 'px;object-fit:cover;border-radius:50%;flex-shrink:0;">';
        }
        $initial = htmlspecialchars(mb_strtoupper(mb_substr($name, 0, 1)));
        return '<span class="d-inline-flex align-items-center justify-content-center" style="width:' . $size . 'px;height:'
            . $size . 'px;border-radius:50%;background:rgba(183,117,255,.25);color:#fff;font-weight:600;flex-shrink:0;">'
            . $initial . '</span>';
    }
}
$statusBadge = [
    'pending'  => ['warning text-dark', t('Pendente')],
    'approved' => ['success', t('Aprovado')],
    'rejected' => ['secondary', t('Rejeitado')],
];
?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= t('Depoimentos') ?></h1>
        <span style="font-size:12px; color:var(--text-faint);">
            <?php if (!empty($pending)): ?>
                <span style="color:#fbbf24;"><?= count($pending) ?> <?= t('a aguardar moderação') ?></span>
            <?php else: ?>
                <?= t('Tudo em dia') ?> · <?= count($all) ?> <?= t('no total') ?>
            <?php endif; ?>
        </span>
    </div>
</div>

<!-- ─── Pendentes ───────────────────────────────────────────── -->
<?php if (!empty($pending)): ?>
<h6 class="text-uppercase mb-3" style="color:var(--text-muted); letter-spacing:.05em;">
    <i class="bi bi-hourglass-split me-1"></i><?= t('A aguardar moderação') ?>
</h6>
<div class="row g-3 mb-4">
    <?php foreach ($pending as $t): ?>
    <div class="col-12">
        <div class="card" style="border-left:3px solid #fbbf24;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <?= avatarTag($t, 36) ?>
                        <strong><?= htmlspecialchars($t['name']) ?></strong>
                        <?php if ($t['role'] || $t['location']): ?>
                            <small style="color:var(--text-muted);">
                                <?= htmlspecialchars(trim(($t['role'] ?? '') . ($t['role'] && $t['location'] ? ' · ' : '') . ($t['location'] ?? ''))) ?>
                            </small>
                        <?php endif; ?>
                        <?php if (!empty($t['user_email'])): ?>
                            <a href="mailto:<?= htmlspecialchars($t['user_email']) ?>" class="small text-decoration-none"
                               style="color:#b775ff;">
                                <i class="bi bi-envelope me-1"></i><?= htmlspecialchars($t['user_email']) ?>
                            </a>
                        <?php endif; ?>
                        <span><?= starRow((int) $t['rating']) ?></span>
                    </div>
                    <small style="color:var(--text-faint);">
                        <i class="bi bi-clock me-1"></i><?= date('d/m/Y H:i', strtotime($t['created_at'])) ?>
                    </small>
                </div>
                <blockquote class="blockquote ps-3 mb-3">
                    <p style="color:var(--text-primary); margin:0;"><?= nl2br(htmlspecialchars($t['content'])) ?></p>
                </blockquote>
                <div class="d-flex gap-2 align-items-center flex-wrap">
                    <form method="POST" action="<?= BASE_URL ?>/admin/testimonials/<?= $t['id'] ?>/approve">
                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="bi bi-check-circle me-1"></i><?= t('Aprovar') ?>
                        </button>
                    </form>
                    <form method="POST" action="<?= BASE_URL ?>/admin/testimonials/<?= $t['id'] ?>/reject">
                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                        <button type="submit" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-slash-circle me-1"></i><?= t('Rejeitar') ?>
                        </button>
                    </form>
                    <form method="POST" action="<?= BASE_URL ?>/admin/testimonials/<?= $t['id'] ?>/delete"
                          onsubmit="return confirm('<?= e_t('Apagar permanentemente?') ?>')">
                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash me-1"></i><?= t('Apagar') ?>
                        </button>
                    </form>
                    <small style="color:var(--text-faint); margin-left:auto;">
                        <i class="bi bi-geo-alt me-1"></i>IP: <?= htmlspecialchars($t['ip_address'] ?? '—') ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- ─── Todos ───────────────────────────────────────────────── -->
<h6 class="text-uppercase mb-3" style="color:var(--text-muted); letter-spacing:.05em;">
    <i class="bi bi-list-ul me-1"></i><?= t('Todos os depoimentos') ?>
</h6>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th><?= t('Nome') ?></th>
                        <th><?= t('Avaliação') ?></th>
                        <th><?= t('Mensagem') ?></th>
                        <th><?= t('Estado') ?></th>
                        <th><?= t('Destaque') ?></th>
                        <th><?= t('Data') ?></th>
                        <th><?= t('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $t): ?>
                    <?php [$badgeClass, $badgeText] = $statusBadge[$t['status']] ?? $statusBadge['pending']; ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <?= avatarTag($t, 32) ?>
                                <div>
                                    <strong><?= htmlspecialchars($t['name']) ?></strong>
                            <?php if ($t['role'] || $t['location']): ?>
                                <br><small style="color:var(--text-muted);">
                                    <?= htmlspecialchars(trim(($t['role'] ?? '') . ($t['role'] && $t['location'] ? ' · ' : '') . ($t['location'] ?? ''))) ?>
                                </small>
                            <?php endif; ?>
                            <?php if (!empty($t['user_email'])): ?>
                                <br><a href="mailto:<?= htmlspecialchars($t['user_email']) ?>" class="small text-decoration-none"
                                       style="color:#b775ff;">
                                    <i class="bi bi-envelope me-1"></i><?= htmlspecialchars($t['user_email']) ?>
                                </a>
                            <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td style="white-space:nowrap;"><?= starRow((int) $t['rating']) ?></td>
                        <td>
                            <small style="color:var(--text-muted);">
                                <?= htmlspecialchars(mb_strimwidth($t['content'], 0, 80, '…')) ?>
                            </small>
                        </td>
                        <td><span class="badge bg-<?= $badgeClass ?>"><?= $badgeText ?></span></td>
                        <td>
                            <form method="POST" action="<?= BASE_URL ?>/admin/testimonials/<?= $t['id'] ?>/feature" class="d-inline">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-link p-0" title="<?= e_t('Alternar destaque na página inicial') ?>">
                                    <i class="bi bi-star<?= $t['is_featured'] ? '-fill' : '' ?>"
                                       style="color:<?= $t['is_featured'] ? '#fbbf24' : 'var(--text-faint)' ?>;font-size:18px;"></i>
                                </button>
                            </form>
                        </td>
                        <td><small style="color:var(--text-muted);"><?= date('d/m/Y', strtotime($t['created_at'])) ?></small></td>
                        <td style="white-space:nowrap;">
                            <?php if ($t['status'] !== 'approved'): ?>
                            <form method="POST" action="<?= BASE_URL ?>/admin/testimonials/<?= $t['id'] ?>/approve" class="d-inline">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-success" title="<?= e_t('Aprovar') ?>"><i class="bi bi-check-lg"></i></button>
                            </form>
                            <?php endif; ?>
                            <?php if ($t['status'] !== 'rejected'): ?>
                            <form method="POST" action="<?= BASE_URL ?>/admin/testimonials/<?= $t['id'] ?>/reject" class="d-inline">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-warning" title="<?= e_t('Rejeitar') ?>"><i class="bi bi-slash-circle"></i></button>
                            </form>
                            <?php endif; ?>
                            <form method="POST" action="<?= BASE_URL ?>/admin/testimonials/<?= $t['id'] ?>/delete" class="d-inline"
                                  onsubmit="return confirm('<?= e_t('Apagar depoimento?') ?>')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-danger" title="<?= e_t('Apagar') ?>"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($all)): ?>
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-chat-square-quote"></i>
                            <p><?= t('Ainda não há depoimentos.') ?></p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<p class="mt-3" style="font-size:12px; color:var(--text-faint);">
    <i class="bi bi-info-circle me-1"></i>
    <?= t('Só aparecem na página inicial os depoimentos aprovados e com a') ?>
    <i class="bi bi-star-fill" style="color:#fbbf24;"></i>
    <?= t('de destaque ativa.') ?>
</p>
