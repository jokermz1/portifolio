<?php $pageTitle = 'Serviços — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title">Serviços</h1>
        <span style="font-size:12px; color:var(--text-faint);"><?= count($services) ?> serviço<?= count($services) !== 1 ? 's' : '' ?></span>
    </div>
    <a href="<?= BASE_URL ?>/admin/services/create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle me-1"></i>Novo Serviço
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Ícone</th>
                        <th>Ordem</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $s): ?>
                    <tr>
                        <td>
                            <p class="mb-0 fw-semibold"><?= htmlspecialchars($s['title']) ?></p>
                            <?php if (!empty($s['description'])): ?>
                            <small style="color:var(--text-muted);"><?= htmlspecialchars(mb_strimwidth($s['description'], 0, 60, '…')) ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($s['icon'])): ?>
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="<?= htmlspecialchars($s['icon']) ?>"
                                              style="font-size:1.4rem; color:var(--accent);"></iconify-icon>
                                <small style="color:var(--text-muted);"><?= htmlspecialchars($s['icon']) ?></small>
                            </div>
                            <?php else: ?>
                            <span style="color:var(--text-faint);">—</span>
                            <?php endif; ?>
                        </td>
                        <td style="color:var(--text-muted);"><?= (int)$s['sort_order'] ?></td>
                        <td>
                            <span class="badge bg-<?= $s['is_active'] ? 'success' : 'secondary' ?>">
                                <?= $s['is_active'] ? 'Ativo' : 'Inativo' ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/services/<?= $s['id'] ?>/edit"
                               class="btn btn-sm btn-outline-primary" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?= BASE_URL ?>/admin/services/<?= $s['id'] ?>/delete"
                                  class="d-inline" onsubmit="return confirm('Apagar serviço?')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-danger" title="Apagar"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($services)): ?>
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-gear"></i>
                            <p>Nenhum serviço criado ainda.</p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
