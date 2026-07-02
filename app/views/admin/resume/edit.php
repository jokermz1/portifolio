<?php $pageTitle = 'Editar Item de Currículo — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title"><?= t('Editar Item') ?></h1>
        <span style="font-size:12px; color:var(--text-faint);">
            <?= $item['type'] === 'education' ? t('Educação') : t('Experiência Profissional') ?>
        </span>
    </div>
    <a href="<?= BASE_URL ?>/admin/resume" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i><?= t('Voltar') ?>
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/resume/<?= $item['id'] ?>/edit" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

            <div class="row g-3">

                <!-- Tipo -->
                <div class="col-md-6">
                    <label class="form-label"><?= t('Tipo') ?> *</label>
                    <div class="d-flex gap-3 mt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type_edu"
                                   value="education" <?= $item['type'] === 'education' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="type_edu">
                                <i class="bi bi-mortarboard me-1" style="color:#B775FF;"></i><?= t('Educação') ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type_exp"
                                   value="experience" <?= $item['type'] === 'experience' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="type_exp">
                                <i class="bi bi-briefcase me-1" style="color:#38bdf8;"></i><?= t('Experiência') ?>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Ordem -->
                <div class="col-md-3">
                    <label class="form-label"><?= t('Ordem') ?></label>
                    <input type="number" name="sort_order" value="<?= (int)$item['sort_order'] ?>"
                           class="form-control" min="0">
                </div>

                <!-- Estado -->
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                               id="is_active" <?= $item['is_active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active"><?= t('Ativo') ?></label>
                    </div>
                </div>

                <!-- Título -->
                <div class="col-12">
                    <label class="form-label" id="title-label">
                        <?= $item['type'] === 'education' ? t('Grau / Título') . ' *' : t('Cargo / Função') . ' *' ?>
                    </label>
                    <input type="text" name="title" class="form-control" required
                           id="title-input"
                           value="<?= htmlspecialchars($item['title']) ?>">
                </div>

                <!-- Período -->
                <div class="col-md-4">
                    <label class="form-label"><?= t('Período') ?></label>
                    <input type="text" name="period" class="form-control"
                           value="<?= htmlspecialchars($item['period'] ?? '') ?>"
                           placeholder="ex: 2018 – 2022">
                </div>

                <!-- Subtítulo -->
                <div class="col-md-8">
                    <label class="form-label" id="subtitle-label">
                        <?= $item['type'] === 'education' ? t('Instituição') : t('Empresa') ?>
                    </label>
                    <input type="text" name="subtitle" class="form-control"
                           id="subtitle-input"
                           value="<?= htmlspecialchars($item['subtitle'] ?? '') ?>">
                </div>

                <!-- Descrição -->
                <div class="col-12">
                    <label class="form-label"><?= t('Descrição') ?></label>
                    <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
                    <small style="color:var(--text-faint); font-size:11px;">
                        <?= t('Pode usar nova linha para separar parágrafos.') ?>
                    </small>
                </div>

                <!-- Anexo / Comprovante -->
                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-paperclip me-1" style="color:var(--accent);"></i>
                        <?= t('Anexo / Comprovante') ?>
                    </label>

                    <?php if (!empty($item['attachment'])): ?>
                    <!-- Ficheiro existente -->
                    <div class="d-flex align-items-center gap-3 mb-2 p-2"
                         style="background:rgba(183,117,255,.06); border:1px solid rgba(183,117,255,.2); border-radius:8px;">
                        <?php
                        $ext = strtolower(pathinfo($item['attachment'], PATHINFO_EXTENSION));
                        $iconClass = match($ext) {
                            'pdf'         => 'bi-file-earmark-pdf-fill',
                            'doc','docx'  => 'bi-file-earmark-word-fill',
                            'jpg','jpeg','png','webp' => 'bi-file-earmark-image-fill',
                            default       => 'bi-file-earmark-fill',
                        };
                        ?>
                        <i class="bi <?= $iconClass ?>" style="color:#B775FF; font-size:22px; flex-shrink:0;"></i>
                        <div style="flex:1; min-width:0;">
                            <p style="font-size:12px; color:var(--text-primary); margin:0; font-weight:600; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                <?= htmlspecialchars($item['attachment_name'] ?? $item['attachment']) ?>
                            </p>
                            <a href="<?= UPLOAD_URL ?>resume/<?= htmlspecialchars($item['attachment']) ?>"
                               target="_blank" style="font-size:11px; color:#B775FF;">
                                <i class="bi bi-box-arrow-up-right me-1"></i><?= t('Abrir ficheiro') ?>
                            </a>
                        </div>
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" name="remove_attachment"
                                   value="1" id="remove_attachment">
                            <label class="form-check-label" for="remove_attachment"
                                   style="font-size:12px; color:#ff6b6b;">
                                <?= t('Apagar') ?>
                            </label>
                        </div>
                    </div>
                    <label class="form-label" style="font-size:12px; color:var(--text-faint); margin-bottom:4px;">
                        <?= t('Substituir por outro ficheiro (opcional):') ?>
                    </label>
                    <?php endif; ?>

                    <input type="file" name="attachment" class="form-control"
                           accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx">
                    <small style="color:var(--text-faint); font-size:11px;">
                        <?= t('PDF, imagem ou documento Word. Máx. 15 MB.') ?>
                        <?= !empty($item['attachment']) ? t('Carregar novo substitui o anterior.') : t('Exemplo: diploma, certificado.') ?>
                    </small>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i><?= t('Guardar Alterações') ?>
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
        titleLabel.textContent    = <?= json_encode(t('Grau / Título') . ' *') ?>;
        subtitleLabel.textContent = <?= json_encode(t('Instituição')) ?>;
    } else {
        titleLabel.textContent    = <?= json_encode(t('Cargo / Função') . ' *') ?>;
        subtitleLabel.textContent = <?= json_encode(t('Empresa')) ?>;
    }
}));
</script>
