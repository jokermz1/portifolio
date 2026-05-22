<?php $pageTitle = 'FAQs — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title">FAQs</h1>
        <span style="font-size:12px; color:var(--text-faint);"><?= count($faqs) ?> pergunta<?= count($faqs) !== 1 ? 's' : '' ?></span>
    </div>
    <a href="<?= BASE_URL ?>/admin/faqs/create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle me-1"></i>Nova FAQ
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Pergunta</th>
                        <th style="width:80px;">Ordem</th>
                        <th style="width:90px;">Estado</th>
                        <th style="width:100px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($faqs as $f): ?>
                    <tr>
                        <td style="color:var(--text-muted);"><?= (int)$f['id'] ?></td>
                        <td><?= htmlspecialchars($f['question']) ?></td>
                        <td style="color:var(--text-muted);"><?= (int)$f['sort_order'] ?></td>
                        <td>
                            <span class="badge bg-<?= $f['is_active'] ? 'success' : 'secondary' ?>">
                                <?= $f['is_active'] ? 'Ativa' : 'Inativa' ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/faqs/<?= $f['id'] ?>/edit"
                               class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?= BASE_URL ?>/admin/faqs/<?= $f['id'] ?>/delete"
                                  class="d-inline" onsubmit="return confirm('Apagar FAQ?')">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                <button class="btn btn-sm btn-outline-danger" title="Apagar"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($faqs)): ?>
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-question-circle"></i>
                            <p>Nenhuma FAQ criada ainda.</p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
