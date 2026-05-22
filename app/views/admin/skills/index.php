<?php $pageTitle = 'Skills — Admin'; ?>

<div class="page-header">
    <div>
        <h1 class="page-title">Skills</h1>
        <span style="font-size:12px; color:var(--text-faint);">Adiciona, edita e reordena as skills que aparecem na página About</span>
    </div>
    <button type="submit" form="skills-form" class="btn btn-primary btn-sm">
        <i class="bi bi-save me-1"></i>Guardar tudo
    </button>
</div>

<?php if ($flash): ?>
<div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show mb-4" role="alert">
    <?= htmlspecialchars($flash['message']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>/admin/skills/save" id="skills-form">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
    <input type="hidden" name="delete_ids" id="delete-ids" value="">

    <div class="card">
        <div class="card-body p-0">

            <!-- Cabeçalho da tabela -->
            <div class="skill-row skill-header-row"
                 style="display:grid; grid-template-columns:1fr 130px 180px 50px 36px;
                        gap:10px; padding:10px 16px; border-bottom:1px solid var(--border);
                        font-size:11px; font-weight:700; color:var(--text-faint);
                        text-transform:uppercase; letter-spacing:.08em;">
                <span>Nome</span>
                <span>Categoria</span>
                <span>Nível</span>
                <span class="text-center">Ord.</span>
                <span></span>
            </div>

            <!-- Lista de skills -->
            <div id="skills-list">
                <?php foreach ($skills as $s): ?>
                <div class="skill-row" data-id="<?= $s['id'] ?>"
                     style="display:grid; grid-template-columns:1fr 130px 180px 50px 36px;
                            gap:10px; padding:10px 16px; align-items:center;
                            border-bottom:1px solid var(--border);">
                    <input type="hidden" name="skill_id[]" value="<?= $s['id'] ?>">
                    <!-- Nome -->
                    <input type="text" name="skill_name[]" class="form-control form-control-sm"
                           value="<?= htmlspecialchars($s['name']) ?>" placeholder="Nome da skill" required>
                    <!-- Categoria -->
                    <input type="text" name="skill_category[]" class="form-control form-control-sm"
                           value="<?= htmlspecialchars($s['category'] ?? 'Geral') ?>"
                           list="cat-list" placeholder="Categoria">
                    <!-- Nível -->
                    <div style="display:flex; align-items:center; gap:8px;">
                        <input type="range" name="skill_level[]"
                               class="skill-range" min="0" max="100" step="5"
                               value="<?= (int)$s['level'] ?>"
                               style="flex:1; accent-color:#B775FF; cursor:pointer;">
                        <span class="level-val"
                              style="min-width:34px; text-align:right; font-size:12px;
                                     font-weight:700; color:#B775FF;">
                            <?= (int)$s['level'] ?>%
                        </span>
                    </div>
                    <!-- Ordem -->
                    <input type="number" name="skill_order[]" class="form-control form-control-sm text-center"
                           value="<?= (int)$s['sort_order'] ?>" min="0" style="padding:4px 6px;">
                    <!-- Apagar -->
                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                            style="padding:4px 8px;" title="Remover">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Botão adicionar -->
            <div style="padding:12px 16px; border-top:1px dashed var(--border);">
                <button type="button" id="add-skill-btn"
                        class="btn btn-sm" style="color:var(--accent); border:1px dashed rgba(183,117,255,.35); background:rgba(183,117,255,.05);">
                    <i class="bi bi-plus-circle me-1"></i>Adicionar Skill
                </button>
            </div>

        </div>
    </div>

    <!-- Datalist categorias -->
    <datalist id="cat-list">
        <option value="Frontend">
        <option value="Backend">
        <option value="Design">
        <option value="DevOps">
        <option value="Mobile">
        <option value="Geral">
    </datalist>

    <div class="d-flex gap-2 mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>Guardar tudo
        </button>
    </div>
</form>

<!-- Template de linha nova (oculto) -->
<template id="skill-row-tpl">
    <div class="skill-row" data-id="0"
         style="display:grid; grid-template-columns:1fr 130px 180px 50px 36px;
                gap:10px; padding:10px 16px; align-items:center;
                border-bottom:1px solid var(--border); background:rgba(183,117,255,.03);">
        <input type="hidden" name="skill_id[]" value="0">
        <input type="text" name="skill_name[]" class="form-control form-control-sm"
               placeholder="Nome da skill" required>
        <input type="text" name="skill_category[]" class="form-control form-control-sm"
               value="Geral" list="cat-list" placeholder="Categoria">
        <div style="display:flex; align-items:center; gap:8px;">
            <input type="range" name="skill_level[]"
                   class="skill-range" min="0" max="100" step="5" value="50"
                   style="flex:1; accent-color:#B775FF; cursor:pointer;">
            <span class="level-val"
                  style="min-width:34px; text-align:right; font-size:12px;
                         font-weight:700; color:#B775FF;">50%</span>
        </div>
        <input type="number" name="skill_order[]" class="form-control form-control-sm text-center"
               value="0" min="0" style="padding:4px 6px;">
        <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                style="padding:4px 8px;" title="Remover">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</template>

<script>
(function () {
    const list      = document.getElementById('skills-list');
    const tpl       = document.getElementById('skill-row-tpl');
    const deleteIds = document.getElementById('delete-ids');
    const toDelete  = [];

    // Slider → live update %
    function bindSlider(row) {
        const range = row.querySelector('.skill-range');
        const val   = row.querySelector('.level-val');
        if (range && val) {
            range.addEventListener('input', () => { val.textContent = range.value + '%'; });
        }
    }

    // Delete button
    function bindDelete(row) {
        row.querySelector('.delete-btn').addEventListener('click', function () {
            const id = parseInt(row.dataset.id);
            if (id > 0) toDelete.push(id);
            row.remove();
            deleteIds.value = toDelete.join(',');
        });
    }

    // Bind existing rows
    list.querySelectorAll('.skill-row').forEach(row => {
        bindSlider(row);
        bindDelete(row);
    });

    // Add new row
    document.getElementById('add-skill-btn').addEventListener('click', function () {
        const clone = tpl.content.cloneNode(true);
        const row   = clone.querySelector('.skill-row');
        bindSlider(row);
        bindDelete(row);
        list.appendChild(clone);
        // Focus the name input
        list.lastElementChild.querySelector('input[type="text"]').focus();
    });
})();
</script>
