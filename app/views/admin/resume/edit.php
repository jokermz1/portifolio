<?php $pageTitle = 'Editar Item de Currículo — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title">Editar Item</h1>
        <span style="font-size:12px; color:var(--text-faint);">
            <?= $item['type'] === 'education' ? 'Educação' : 'Experiência Profissional' ?>
        </span>
    </div>
    <a href="<?= BASE_URL ?>/admin/resume" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/resume/<?= $item['id'] ?>/edit">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

            <div class="row g-3">

                <!-- Tipo -->
                <div class="col-md-6">
                    <label class="form-label">Tipo *</label>
                    <div class="d-flex gap-3 mt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type_edu"
                                   value="education" <?= $item['type'] === 'education' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="type_edu">
                                <i class="bi bi-mortarboard me-1" style="color:#B775FF;"></i>Educação
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type_exp"
                                   value="experience" <?= $item['type'] === 'experience' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="type_exp">
                                <i class="bi bi-briefcase me-1" style="color:#38bdf8;"></i>Experiência
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Ordem -->
                <div class="col-md-3">
                    <label class="form-label">Ordem</label>
                    <input type="number" name="sort_order" value="<?= (int)$item['sort_order'] ?>"
                           class="form-control" min="0">
                </div>

                <!-- Estado -->
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                               id="is_active" <?= $item['is_active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">Ativo</label>
                    </div>
                </div>

                <!-- Título -->
                <div class="col-12">
                    <label class="form-label" id="title-label">
                        <?= $item['type'] === 'education' ? 'Grau / Título *' : 'Cargo / Função *' ?>
                    </label>
                    <input type="text" name="title" class="form-control" required
                           id="title-input"
                           value="<?= htmlspecialchars($item['title']) ?>">
                </div>

                <!-- Período -->
                <div class="col-md-4">
                    <label class="form-label">Período</label>
                    <input type="text" name="period" class="form-control"
                           value="<?= htmlspecialchars($item['period'] ?? '') ?>"
                           placeholder="ex: 2018 – 2022">
                </div>

                <!-- Subtítulo -->
                <div class="col-md-8">
                    <label class="form-label" id="subtitle-label">
                        <?= $item['type'] === 'education' ? 'Instituição' : 'Empresa' ?>
                    </label>
                    <input type="text" name="subtitle" class="form-control"
                           id="subtitle-input"
                           value="<?= htmlspecialchars($item['subtitle'] ?? '') ?>">
                </div>

                <!-- Descrição -->
                <div class="col-12">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
                    <small style="color:var(--text-faint); font-size:11px;">
                        Pode usar nova linha para separar parágrafos.
                    </small>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Guardar Alterações
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
const radios        = document.querySelectorAll('input[name="type"]');
const titleLabel    = document.getElementById('title-label');
const subtitleLabel = document.getElementById('subtitle-label');

radios.forEach(r => r.addEventListener('change', () => {
    if (r.value === 'education') {
        titleLabel.textContent    = 'Grau / Título *';
        subtitleLabel.textContent = 'Instituição';
    } else {
        titleLabel.textContent    = 'Cargo / Função *';
        subtitleLabel.textContent = 'Empresa';
    }
}));
</script>
