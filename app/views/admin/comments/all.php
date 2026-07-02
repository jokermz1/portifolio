<?php $pageTitle = 'Todos os Comentários — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= t('Todos os Comentários') ?></h1>
        <span style="font-size:12px; color:var(--text-faint);"><?= count($comments) ?> <?= t('Comentários') ?></span>
    </div>
    <a href="<?= BASE_URL ?>/admin/comments/pending" class="btn btn-outline-warning btn-sm">
        <i class="bi bi-hourglass me-1"></i><?= t('Pendentes') ?>
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th><?= t('Utilizador') ?></th>
                        <th><?= t('Tipo') ?></th>
                        <th><?= t('Contexto') ?></th>
                        <th><?= t('Conteúdo') ?></th>
                        <th><?= t('Estado') ?></th>
                        <th><?= t('Data') ?></th>
                        <th>IP</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $c): ?>
                    <?php
                    $statusColor = ['pending'=>'warning','approved'=>'success','rejected'=>'danger'];
                    $typeColor   = ['comment'=>'secondary','suggestion'=>'info','critique'=>'warning'];
                    ?>
                    <tr>
                        <td>
                            <div><?= htmlspecialchars($c['user_name']) ?></div>
                            <small style="color:var(--text-muted);"><?= htmlspecialchars($c['user_email']) ?></small>
                        </td>
                        <td>
                            <span class="badge bg-<?= $typeColor[$c['type']] ?? 'secondary' ?>">
                                <?= $c['type'] ?>
                            </span>
                        </td>
                        <td>
                            <small style="color:var(--text-muted);"><?= $c['entity_type'] ?> #<?= $c['entity_id'] ?></small>
                        </td>
                        <td style="max-width:200px;">
                            <small><?= htmlspecialchars(mb_substr($c['content'], 0, 60)) ?>…</small>
                            <?php if ($c['is_edited']): ?>
                                <br><small style="color:var(--text-muted); font-style:italic;"><?= t('editado') ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?= $statusColor[$c['status']] ?? 'secondary' ?>">
                                <?= $c['status'] ?>
                            </span>
                        </td>
                        <td><small style="color:var(--text-muted);"><?= date('d/m/Y', strtotime($c['created_at'])) ?></small></td>
                        <td><small style="color:var(--text-muted); font-family:monospace;"><?= htmlspecialchars($c['ip_address']) ?></small></td>
                        <td>
                            <?php if ($c['status'] === 'pending'): ?>
                            <form method="POST" action="<?= BASE_URL ?>/admin/comments/<?= $c['id'] ?>/approve" class="d-inline">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-success py-0" title="<?= e_t('Aprovar') ?>"><i class="bi bi-check"></i></button>
                            </form>
                            <form method="POST" action="<?= BASE_URL ?>/admin/comments/<?= $c['id'] ?>/reject" class="d-inline">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-warning py-0" title="<?= e_t('Rejeitar') ?>"><i class="bi bi-slash"></i></button>
                            </form>
                            <?php endif; ?>
                            <form method="POST" action="<?= BASE_URL ?>/admin/comments/<?= $c['id'] ?>/delete" class="d-inline"
                                  onsubmit="return confirm('<?= e_t('Apagar?') ?>')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-danger py-0" title="<?= e_t('Apagar') ?>"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($comments)): ?>
                    <tr><td colspan="8">
                        <div class="empty-state">
                            <i class="bi bi-chat-dots"></i>
                            <p><?= t('Nenhum comentário ainda.') ?></p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
