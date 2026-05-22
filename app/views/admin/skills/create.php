<?php $pageTitle = 'Nova Skill — Admin'; ?>
<div class="page-header">
    <div>
        <h1 class="page-title">Nova Skill</h1>
    </div>
    <a href="<?= BASE_URL ?>/admin/skills" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<div class="card" style="max-width:560px;">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/admin/skills/create">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

            <div class="row g-3">

                <div class="col-12">
                    <label class="form-label">Nome da Skill *</label>
                    <input type="text" name="name" class="form-control" required
                           placeholder="ex: PHP, React, Photoshop">
                </div>

                <div class="col-12">
                    <label class="form-label">Nível — <span id="level-display">50</span>%</label>
                    <input type="range" name="level" id="level-range" class="form-range"
                           min="0" max="100" step="5" value="50">
                    <div style="display:flex; justify-content:space-between; font-size:11px; color:var(--text-faint); margin-top:4px;">
                        <span>0%</span><span>25%</span><span>50%</span><span>75%</span><span>100%</span>
                    </div>
                    <!-- Preview bar -->
                    <div style="height:5px; background:rgba(255,255,255,.07); border-radius:3px; overflow:hidden; margin-top:10px;">
                        <div id="level-preview" style="height:100%; width:50%; background:linear-gradient(90deg,#B775FF,#d4a6ff); border-radius:3px; transition:width .2s;"></div>
                    </div>
                </div>

                <div class="col-md-8">
                    <label class="form-label">Categoria</label>
                    <input type="text" name="category" class="form-control"
                           placeholder="ex: Frontend, Backend, Design"
                           list="cat-suggestions" value="Geral">
                    <datalist id="cat-suggestions">
                        <option value="Frontend">
                        <option value="Backend">
                        <option value="Design">
                        <option value="DevOps">
                        <option value="Mobile">
                        <option value="Geral">
                    </datalist>
                    <small style="color:var(--text-faint); font-size:11px;">Agrupa as skills na página About.</small>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Ordem</label>
                    <input type="number" name="sort_order" class="form-control" value="0" min="0">
                </div>

                <div class="col-12 pt-1">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>Adicionar Skill
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
const range   = document.getElementById('level-range');
const display = document.getElementById('level-display');
const preview = document.getElementById('level-preview');
range.addEventListener('input', function() {
    display.textContent = this.value;
    preview.style.width = this.value + '%';
});
</script>
