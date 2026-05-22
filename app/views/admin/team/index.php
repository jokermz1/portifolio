<?php $pageTitle = 'Team — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title">Team Members</h1>
        <span style="font-size:12px; color:var(--text-faint);"><?= count($members) ?> membro<?= count($members) !== 1 ? 's' : '' ?></span>
    </div>
    <a href="<?= BASE_URL ?>/admin/team/create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle me-1"></i>Novo Membro
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Função</th>
                        <th>Ordem</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $m): ?>
                    <tr>
                        <td>
                            <?php if (!empty($m['photo'])): ?>
                                <img src="<?= UPLOAD_URL ?>team/<?= htmlspecialchars($m['photo']) ?>"
                                     width="40" height="40"
                                     style="object-fit:cover;border-radius:50%;" alt="">
                            <?php else: ?>
                                <div class="avatar-placeholder rounded-circle" style="width:40px;height:40px;">
                                    <i class="bi bi-person" style="font-size:15px;"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="fw-semibold"><?= htmlspecialchars($m['name']) ?></td>
                        <td><small style="color:var(--text-muted);"><?= htmlspecialchars($m['role'] ?? '—') ?></small></td>
                        <td style="color:var(--text-muted);"><?= (int)$m['sort_order'] ?></td>
                        <td>
                            <span class="badge bg-<?= $m['is_active'] ? 'success' : 'secondary' ?>">
                                <?= $m['is_active'] ? 'Ativo' : 'Inativo' ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/team/<?= $m['id'] ?>/edit"
                               class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= BASE_URL ?>/admin/team/<?= $m['id'] ?>/delete"
                                  class="d-inline" onsubmit="return confirm('Apagar membro?')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-danger" title="Apagar"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($members)): ?>
                    <tr><td colspan="6">
                        <div class="empty-state">
                            <i class="bi bi-people"></i>
                            <p>Nenhum membro adicionado ainda.</p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
