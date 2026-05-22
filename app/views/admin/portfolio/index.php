<?php $pageTitle = 'Portfólio — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title">Projetos</h1>
        <span style="font-size:12px; color:var(--text-faint);"><?= count($projects) ?> projeto<?= count($projects) !== 1 ? 's' : '' ?></span>
    </div>
    <a href="<?= BASE_URL ?>/admin/portfolio/create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle me-1"></i>Novo Projeto
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Destaque</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $p): ?>
                    <tr>
                        <td>
                            <?php if ($p['image']): ?>
                                <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($p['image']) ?>"
                                     width="50" height="40" style="object-fit:cover;border-radius:6px;" alt="">
                            <?php else: ?>
                                <div class="avatar-placeholder rounded" style="width:50px;height:40px;">
                                    <i class="bi bi-image" style="font-size:14px;"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($p['title']) ?></td>
                        <td><small style="color:var(--text-muted);"><?= htmlspecialchars($p['category'] ?? '—') ?></small></td>
                        <td>
                            <span class="badge bg-<?= $p['is_published'] ? 'success' : 'secondary' ?>">
                                <?= $p['is_published'] ? 'Publicado' : 'Rascunho' ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($p['is_featured']): ?>
                                <i class="bi bi-star-fill" style="color:#fbbf24;"></i>
                            <?php else: ?>
                                <i class="bi bi-star" style="color:var(--text-faint);"></i>
                            <?php endif; ?>
                        </td>
                        <td><small style="color:var(--text-muted);"><?= date('d/m/Y', strtotime($p['created_at'])) ?></small></td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/portfolio/<?= $p['id'] ?>/edit"
                               class="btn btn-sm btn-outline-primary" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?= BASE_URL ?>/admin/portfolio/<?= $p['id'] ?>/delete" class="d-inline"
                                  onsubmit="return confirm('Apagar projeto?')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($flash['_csrf'] ?? '') ?>">
                                <button class="btn btn-sm btn-outline-danger" title="Apagar"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($projects)): ?>
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-folder2-open"></i>
                            <p>Nenhum projeto criado ainda.</p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
