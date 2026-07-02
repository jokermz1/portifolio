<?php $pageTitle = 'Utilizadores — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= t('Utilizadores') ?></h1>
        <span style="font-size:12px; color:var(--text-faint);"><?= count($users) ?> <?= t('Utilizadores') ?></span>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th><?= t('Utilizador') ?></th>
                        <th><?= t('Email') ?></th>
                        <th><?= t('Registado em') ?></th>
                        <th><?= t('Estado') ?></th>
                        <th><?= t('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <?php if ($u['avatar']): ?>
                                    <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($u['avatar']) ?>"
                                         class="rounded-circle" width="32" height="32"
                                         style="object-fit:cover;" alt="">
                                <?php else: ?>
                                    <div class="avatar-placeholder rounded-circle" style="width:32px;height:32px;">
                                        <i class="bi bi-person" style="font-size:14px;"></i>
                                    </div>
                                <?php endif; ?>
                                <?= htmlspecialchars($u['name']) ?>
                            </div>
                        </td>
                        <td style="color:var(--text-muted);"><?= htmlspecialchars($u['email']) ?></td>
                        <td style="color:var(--text-muted);"><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                        <td>
                            <?php if ($u['is_active']): ?>
                                <span class="badge bg-success"><?= t('Ativo') ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger"><?= t('Suspenso') ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/users/<?= $u['id'] ?>"
                               class="btn btn-sm btn-outline-secondary" title="<?= e_t('Ver detalhes') ?>">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form method="POST" action="<?= BASE_URL ?>/admin/users/<?= $u['id'] ?>/toggle" class="d-inline"
                                  onsubmit="return confirm('<?= $u['is_active'] ? e_t('Suspender este utilizador?') : e_t('Reativar este utilizador?') ?>')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button type="submit"
                                        class="btn btn-sm <?= $u['is_active'] ? 'btn-outline-danger' : 'btn-outline-secondary' ?>">
                                    <i class="bi bi-<?= $u['is_active'] ? 'ban' : 'check-circle' ?>"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($users)): ?>
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-people"></i>
                            <p><?= t('Nenhum utilizador registado ainda.') ?></p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
