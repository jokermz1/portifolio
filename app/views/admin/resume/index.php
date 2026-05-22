<?php
$pageTitle = 'Currículo — Admin';
$settings  = (new Setting())->allKeyed();
?>
<div class="page-header">
    <div>
        <h1 class="page-title">Currículo</h1>
        <span style="font-size:12px; color:var(--text-faint);">Educação &amp; Experiência Profissional</span>
    </div>
    <?php if ($items !== null): ?>
    <a href="<?= BASE_URL ?>/admin/resume/create" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle me-1"></i>Novo Item
    </a>
    <?php endif; ?>
</div>

<?php if ($items === null): ?>
<!-- Aviso de migração pendente -->
<div class="card mb-4" style="border-color:rgba(251,191,36,.3);">
    <div class="card-body d-flex align-items-start gap-3" style="padding:20px 24px;">
        <i class="bi bi-exclamation-triangle-fill" style="color:#fbbf24; font-size:22px; flex-shrink:0; margin-top:2px;"></i>
        <div>
            <p class="fw-semibold mb-1" style="color:#fbbf24;">Tabela <code>resume_items</code> não existe ainda</p>
            <p class="mb-3" style="font-size:13px; color:var(--text-muted);">
                É necessário executar a migração para criar a tabela na base de dados.
            </p>
            <a href="<?= BASE_URL ?>/migrate_resume.php" target="_blank"
               class="btn btn-sm btn-warning text-dark fw-semibold">
                <i class="bi bi-play-circle me-1"></i>Executar Migração
            </a>
            <small class="d-block mt-2" style="color:var(--text-faint); font-size:11px;">
                Abre numa nova aba. Depois fecha e recarrega esta página.
            </small>
        </div>
    </div>
</div>

<?php else: ?>

<!-- Sumário de texto -->
<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="bi bi-person-lines-fill" style="color:var(--accent);"></i>
        Sumário do Perfil
        <small style="color:var(--text-faint); margin-left:auto; font-weight:400;">
            Aparece na secção Resume da página About Me
        </small>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/resume/summary">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
            <div class="mb-3">
                <label class="form-label">Resumo Profissional</label>
                <textarea name="resume_summary" class="form-control" rows="3"
                    placeholder="Ex: Desenvolvedor com X anos de experiência em..."><?= htmlspecialchars($settings['resume_summary'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-save me-1"></i>Guardar Sumário
            </button>
        </form>
    </div>
</div>

<!-- Educação & Experiência -->
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-mortarboard-fill" style="color:#B775FF;"></i>
                Educação
                <span class="badge ms-1" style="background:rgba(255,255,255,.08); color:var(--text-muted);">
                    <?= count(array_filter($items, fn($i) => $i['type'] === 'education')) ?>
                </span>
            </div>
            <div class="card-body p-0">
                <?php $edu = array_values(array_filter($items, fn($i) => $i['type'] === 'education')); ?>
                <?php if (!empty($edu)): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Período</th>
                                <th>Instituição</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($edu as $item): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($item['title']) ?></td>
                                <td style="color:var(--text-muted); white-space:nowrap;"><?= htmlspecialchars($item['period'] ?? '—') ?></td>
                                <td style="color:var(--text-muted);"><?= htmlspecialchars($item['subtitle'] ?? '—') ?></td>
                                <td>
                                    <span class="badge bg-<?= $item['is_active'] ? 'success' : 'secondary' ?>">
                                        <?= $item['is_active'] ? 'Ativo' : 'Inativo' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>/admin/resume/<?= $item['id'] ?>/edit"
                                       class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="<?= BASE_URL ?>/admin/resume/<?= $item['id'] ?>/delete"
                                          class="d-inline" onsubmit="return confirm('Apagar item?')">
                                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                        <button class="btn btn-sm btn-outline-danger" title="Apagar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-mortarboard"></i>
                    <p>Nenhuma formação adicionada ainda.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-briefcase-fill" style="color:#38bdf8;"></i>
                Experiência Profissional
                <span class="badge ms-1" style="background:rgba(255,255,255,.08); color:var(--text-muted);">
                    <?= count(array_filter($items, fn($i) => $i['type'] === 'experience')) ?>
                </span>
            </div>
            <div class="card-body p-0">
                <?php $exp = array_values(array_filter($items, fn($i) => $i['type'] === 'experience')); ?>
                <?php if (!empty($exp)): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Cargo</th>
                                <th>Período</th>
                                <th>Empresa</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($exp as $item): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($item['title']) ?></td>
                                <td style="color:var(--text-muted); white-space:nowrap;"><?= htmlspecialchars($item['period'] ?? '—') ?></td>
                                <td style="color:var(--text-muted);"><?= htmlspecialchars($item['subtitle'] ?? '—') ?></td>
                                <td>
                                    <span class="badge bg-<?= $item['is_active'] ? 'success' : 'secondary' ?>">
                                        <?= $item['is_active'] ? 'Ativo' : 'Inativo' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>/admin/resume/<?= $item['id'] ?>/edit"
                                       class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="<?= BASE_URL ?>/admin/resume/<?= $item['id'] ?>/delete"
                                          class="d-inline" onsubmit="return confirm('Apagar item?')">
                                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                                        <button class="btn btn-sm btn-outline-danger" title="Apagar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-briefcase"></i>
                    <p>Nenhuma experiência adicionada ainda.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>
