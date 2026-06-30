<?php $pageTitle = 'Novo Item de Currículo — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title">Novo Item</h1>
        <span style="font-size:12px; color:var(--text-faint);">Educação ou Experiência Profissional</span>
    </div>
    <a href="<?= BASE_URL ?>/admin/resume" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/resume/create" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

            <div class="row g-3">

                <!-- Tipo -->
                <div class="col-md-6">
                    <label class="form-label">Tipo *</label>
                    <div class="d-flex gap-3 mt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type_edu"
                                   value="education" checked>
                            <label class="form-check-label" for="type_edu">
                                <i class="bi bi-mortarboard me-1" style="color:#B775FF;"></i>Educação
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type_exp"
                                   value="experience">
                            <label class="form-check-label" for="type_exp">
                                <i class="bi bi-briefcase me-1" style="color:#38bdf8;"></i>Experiência
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Ordem -->
                <div class="col-md-3">
                    <label class="form-label">Ordem</label>
                    <input type="number" name="sort_order" value="0" class="form-control" min="0">
                </div>

                <!-- Estado -->
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                               id="is_active" checked>
                        <label class="form-check-label" for="is_active">Ativo</label>
                    </div>
                </div>

                <!-- Título -->
                <div class="col-12">
                    <label class="form-label" id="title-label">Grau / Título *</label>
                    <input type="text" name="title" class="form-control" required
                           id="title-input" placeholder="ex: Licenciatura em Engenharia Informática">
                </div>

                <!-- Período -->
                <div class="col-md-4">
                    <label class="form-label">Período</label>
                    <input type="text" name="period" class="form-control"
                           placeholder="ex: 2018 – 2022">
                </div>

                <!-- Subtítulo -->
                <div class="col-md-8">
                    <label class="form-label" id="subtitle-label">Instituição</label>
                    <input type="text" name="subtitle" class="form-control"
                           id="subtitle-input" placeholder="ex: Universidade Eduardo Mondlane">
                </div>

                <!-- Descrição -->
                <div class="col-12">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" class="form-control" rows="4"
                        placeholder="Descreva o percurso, responsabilidades ou conquistas..."></textarea>
                    <small style="color:var(--text-faint); font-size:11px;">
                        Pode usar nova linha para separar parágrafos ou criar uma lista com "- item".
                    </small>
                </div>

                <!-- Anexo / Comprovante -->
                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-paperclip me-1" style="color:var(--accent);"></i>
                        Anexo / Comprovante
                    </label>
                    <input type="file" name="attachment" class="form-control"
                           accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx">
                    <small style="color:var(--text-faint); font-size:11px;">
                        Opcional. PDF, imagem ou documento Word. Máx. 15 MB.
                        Exemplo: diploma, certificado, carta de recomendação.
                    </small>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Criar Item
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
const radios = document.querySelectorAll('input[name="type"]');
const titleLabel    = document.getElementById('title-label');
const titleInput    = document.getElementById('title-input');
const subtitleLabel = document.getElementById('subtitle-label');
const subtitleInput = document.getElementById('subtitle-input');

function updateLabels(type) {
    if (type === 'education') {
        titleLabel.textContent    = 'Grau / Título *';
        titleInput.placeholder    = 'ex: Licenciatura em Engenharia Informática';
        subtitleLabel.textContent = 'Instituição';
        subtitleInput.placeholder = 'ex: Universidade Eduardo Mondlane';
    } else {
        titleLabel.textContent    = 'Cargo / Função *';
        titleInput.placeholder    = 'ex: Desenvolvedor Full Stack';
        subtitleLabel.textContent = 'Empresa';
        subtitleInput.placeholder = 'ex: TechCorp, Maputo';
    }
}

radios.forEach(r => r.addEventListener('change', () => updateLabels(r.value)));
</script>
