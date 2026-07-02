<?php $pageTitle = 'Mensagens — Admin'; ?>
<?php $unread = array_filter($messages, fn($m) => !$m['is_read']); ?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= t('Mensagens') ?></h1>
        <span style="font-size:12px; color:var(--text-faint);">
            <?= count($messages) ?> <?= t('Mensagens') ?>
            <?php if (count($unread) > 0): ?>
            · <span style="color:var(--accent);"><?= count($unread) ?> <?= t('não lidas') ?></span>
            <?php endif; ?>
        </span>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th><?= t('Remetente') ?></th>
                        <th><?= t('Assunto') ?></th>
                        <th><?= t('Data') ?></th>
                        <th><?= t('Estado') ?></th>
                        <th><?= t('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $m): ?>
                    <tr class="<?= !$m['is_read'] ? 'table-active' : '' ?>">
                        <td>
                            <p class="mb-0 fw-semibold" style="color:<?= !$m['is_read'] ? 'var(--text-primary)' : 'var(--text-muted)' ?>">
                                <?= htmlspecialchars($m['name']) ?>
                            </p>
                            <small style="color:var(--text-faint);"><?= htmlspecialchars($m['email']) ?></small>
                        </td>
                        <td style="color:<?= !$m['is_read'] ? 'var(--text-primary)' : 'var(--text-muted)' ?>">
                            <?= htmlspecialchars(mb_strimwidth($m['subject'] ?: t('(sem assunto)'), 0, 55, '…')) ?>
                        </td>
                        <td style="white-space:nowrap; color:var(--text-muted);">
                            <?= date('d/m/Y H:i', strtotime($m['created_at'])) ?>
                        </td>
                        <td>
                            <?php if (!$m['is_read']): ?>
                            <span class="badge" style="background:var(--accent-dim); color:var(--accent); border:1px solid var(--accent-glow);"><?= t('Nova') ?></span>
                            <?php else: ?>
                            <span class="badge" style="background:rgba(255,255,255,.06); color:var(--text-muted);"><?= t('Lida') ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/messages/<?= $m['id'] ?>"
                               class="btn btn-sm btn-outline-secondary" title="<?= e_t('Ver mensagem') ?>">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form method="POST" action="<?= BASE_URL ?>/admin/messages/<?= $m['id'] ?>/delete"
                                  class="d-inline" onsubmit="return confirm('<?= e_t('Apagar esta mensagem?') ?>')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-danger" title="<?= e_t('Apagar') ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($messages)): ?>
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p><?= t('Nenhuma mensagem recebida ainda.') ?></p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
