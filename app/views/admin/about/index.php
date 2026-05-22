<?php $pageTitle = 'About Me — Admin'; ?>

<div class="page-header">
    <div>
        <h1 class="page-title">About Me</h1>
        <span style="font-size:12px; color:var(--text-faint);">Informação pessoal exibida na página pública About</span>
    </div>
    <a href="<?= BASE_URL ?>/about" target="_blank" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-eye me-1"></i>Ver página
    </a>
</div>

<?php if ($flash): ?>
<div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show mb-4" role="alert">
    <?= htmlspecialchars($flash['message']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>/admin/about" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">

        <!-- ── Coluna esquerda ──────────────────────────────── -->
        <div class="col-lg-8">

            <!-- Dados pessoais -->
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="bi bi-person-fill" style="color:var(--accent);"></i>
                    Dados Pessoais
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nome Completo</label>
                            <input type="text" name="owner_name" class="form-control"
                                   placeholder="ex: João Silva"
                                   value="<?= htmlspecialchars($settings['owner_name'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Título / Perfil</label>
                            <input type="text" name="owner_title" class="form-control"
                                   placeholder="ex: Full Stack Developer"
                                   value="<?= htmlspecialchars($settings['owner_title'] ?? '') ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Biografia</label>
                            <textarea name="owner_bio" class="form-control" rows="6"
                                      placeholder="Escreve um texto sobre ti. Cada parágrafo separado por uma linha vazia."><?= htmlspecialchars($settings['owner_bio'] ?? '') ?></textarea>
                            <small style="color:var(--text-faint); font-size:11px;">
                                Cada linha em branco cria um novo parágrafo na página About.
                            </small>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Contactos -->
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="bi bi-telephone-fill" style="color:var(--accent);"></i>
                    Contactos
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="owner_email" class="form-control"
                                       placeholder="tu@exemplo.com"
                                       value="<?= htmlspecialchars($settings['owner_email'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Telefone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                <input type="text" name="owner_phone" class="form-control"
                                       placeholder="ex: +258 84 000 0000"
                                       value="<?= htmlspecialchars($settings['owner_phone'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Localidade / Morada</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" name="owner_address" class="form-control"
                                       placeholder="ex: Maputo, Moçambique"
                                       value="<?= htmlspecialchars($settings['owner_address'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- CV -->
                        <div class="col-12">
                            <label class="form-label">Currículo (CV)</label>

                            <!-- Tabs: Ficheiro ou Link -->
                            <ul class="nav nav-pills mb-3" style="gap:6px;" id="cv-tabs">
                                <li class="nav-item">
                                    <button type="button" class="nav-link <?= empty($settings['cv_file']) ? 'active' : '' ?>"
                                            id="tab-link" style="font-size:12px; padding:5px 14px;"
                                            onclick="switchCvTab('link')">
                                        <i class="bi bi-link-45deg me-1"></i>Link URL
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link <?= !empty($settings['cv_file']) ? 'active' : '' ?>"
                                            id="tab-file" style="font-size:12px; padding:5px 14px;"
                                            onclick="switchCvTab('file')">
                                        <i class="bi bi-file-earmark-pdf me-1"></i>Upload PDF
                                    </button>
                                </li>
                            </ul>

                            <!-- Link URL -->
                            <div id="cv-link-panel" style="display:<?= empty($settings['cv_file']) ? 'block' : 'none' ?>">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                    <input type="url" name="cv_url" class="form-control"
                                           placeholder="https://drive.google.com/..."
                                           value="<?= htmlspecialchars($settings['cv_url'] ?? '') ?>">
                                </div>
                                <small style="color:var(--text-faint); font-size:11px;">
                                    Link externo (Google Drive, Dropbox, etc.).
                                </small>
                            </div>

                            <!-- Upload PDF -->
                            <div id="cv-file-panel" style="display:<?= !empty($settings['cv_file']) ? 'block' : 'none' ?>">
                                <?php if (!empty($settings['cv_file'])): ?>
                                <div class="d-flex align-items-center gap-2 mb-2 p-2"
                                     style="background:rgba(183,117,255,.06); border:1px solid rgba(183,117,255,.2); border-radius:6px;">
                                    <i class="bi bi-file-earmark-pdf-fill" style="color:#B775FF; font-size:18px;"></i>
                                    <div style="flex:1; min-width:0;">
                                        <p style="font-size:12px; color:var(--text-primary); margin:0; font-weight:600;">
                                            <?= htmlspecialchars($settings['cv_file']) ?>
                                        </p>
                                        <a href="<?= UPLOAD_URL ?>cv/<?= htmlspecialchars($settings['cv_file']) ?>"
                                           target="_blank" style="font-size:11px; color:#B775FF;">
                                            <i class="bi bi-eye me-1"></i>Abrir PDF
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <input type="file" name="cv_file" class="form-control" accept="application/pdf">
                                <small style="color:var(--text-faint); font-size:11px;">
                                    Apenas PDF. Máx. 10 MB.
                                    <?= !empty($settings['cv_file']) ? 'Carregar novo substitui o anterior.' : '' ?>
                                </small>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Redes Sociais -->
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="bi bi-share-fill" style="color:var(--accent);"></i>
                    Redes Sociais
                    <small style="color:var(--text-faint); margin-left:auto; font-weight:400;">Deixa em branco para não mostrar</small>
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-github me-1"></i>GitHub</label>
                            <input type="url" name="social_github" class="form-control"
                                   placeholder="https://github.com/utilizador"
                                   value="<?= htmlspecialchars($settings['social_github'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-linkedin me-1"></i>LinkedIn</label>
                            <input type="url" name="social_linkedin" class="form-control"
                                   placeholder="https://linkedin.com/in/utilizador"
                                   value="<?= htmlspecialchars($settings['social_linkedin'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-twitter-x me-1"></i>Twitter / X</label>
                            <input type="url" name="social_twitter" class="form-control"
                                   placeholder="https://twitter.com/utilizador"
                                   value="<?= htmlspecialchars($settings['social_twitter'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-instagram me-1"></i>Instagram</label>
                            <input type="url" name="social_instagram" class="form-control"
                                   placeholder="https://instagram.com/utilizador"
                                   value="<?= htmlspecialchars($settings['social_instagram'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-facebook me-1"></i>Facebook</label>
                            <input type="url" name="social_facebook" class="form-control"
                                   placeholder="https://facebook.com/utilizador"
                                   value="<?= htmlspecialchars($settings['social_facebook'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-youtube me-1"></i>YouTube</label>
                            <input type="url" name="social_youtube" class="form-control"
                                   placeholder="https://youtube.com/@canal"
                                   value="<?= htmlspecialchars($settings['social_youtube'] ?? '') ?>">
                        </div>

                    </div>
                </div>
            </div>

        </div><!-- /col-lg-8 -->

        <!-- ── Coluna direita: Foto ─────────────────────────── -->
        <div class="col-lg-4">
            <div class="card" style="position:sticky; top:20px;">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="bi bi-image-fill" style="color:var(--accent);"></i>
                    Foto de Perfil
                </div>
                <div class="card-body text-center">

                    <!-- Preview da foto actual -->
                    <?php if (!empty($settings['owner_photo'])): ?>
                    <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($settings['owner_photo']) ?>"
                         id="photo-preview"
                         style="width:160px; height:200px; object-fit:cover; border-radius:10px; border:2px solid rgba(183,117,255,.25); display:block; margin:0 auto 16px;"
                         alt="Foto actual">
                    <?php else: ?>
                    <div id="photo-placeholder"
                         style="width:160px; height:200px; border-radius:10px; background:rgba(183,117,255,.06); border:2px dashed rgba(183,117,255,.2); display:flex; align-items:center; justify-content:center; margin:0 auto 16px; color:rgba(183,117,255,.3); font-size:52px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <img src="" id="photo-preview" style="width:160px; height:200px; object-fit:cover; border-radius:10px; border:2px solid rgba(183,117,255,.25); display:none; margin:0 auto 16px;" alt="">
                    <?php endif; ?>

                    <label class="btn btn-outline-primary btn-sm w-100" for="photo-input">
                        <i class="bi bi-upload me-1"></i>
                        <?= !empty($settings['owner_photo']) ? 'Alterar foto' : 'Carregar foto' ?>
                    </label>
                    <input type="file" id="photo-input" name="owner_photo"
                           accept="image/jpeg,image/png,image/webp"
                           class="d-none">
                    <p style="font-size:11px; color:var(--text-faint); margin-top:10px; margin-bottom:0;">
                        JPG, PNG ou WEBP. Recomendado 3:4 (ex: 360×480px).
                    </p>

                    <?php if (!empty($settings['owner_photo'])): ?>
                    <p style="font-size:11px; color:var(--text-faint); margin-top:6px;">
                        Foto actual: <code style="color:var(--accent);"><?= htmlspecialchars($settings['owner_photo']) ?></code>
                    </p>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Pré-visualização rápida -->
            <div class="card mt-3">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="bi bi-eye" style="color:var(--accent);"></i>
                    Pré-visualização rápida
                </div>
                <div class="card-body" style="font-size:12px; color:var(--text-muted); line-height:1.8;">
                    <p class="mb-1"><strong style="color:var(--text-secondary);">Nome:</strong> <span id="prev-name"><?= htmlspecialchars($settings['owner_name'] ?? '—') ?></span></p>
                    <p class="mb-1"><strong style="color:var(--text-secondary);">Perfil:</strong> <span id="prev-title"><?= htmlspecialchars($settings['owner_title'] ?? '—') ?></span></p>
                    <p class="mb-0"><strong style="color:var(--text-secondary);">Email:</strong> <span id="prev-email"><?= htmlspecialchars($settings['owner_email'] ?? '—') ?></span></p>
                </div>
            </div>
        </div>

    </div><!-- /row -->

    <!-- Botão Guardar -->
    <div class="d-flex gap-2 mt-2 mb-4">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-save me-1"></i>Guardar About Me
        </button>
        <a href="<?= BASE_URL ?>/about" target="_blank" class="btn btn-outline-secondary">
            <i class="bi bi-box-arrow-up-right me-1"></i>Ver resultado
        </a>
    </div>

</form>

<script>
// Foto preview ao seleccionar
document.getElementById('photo-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        const img = document.getElementById('photo-preview');
        const ph  = document.getElementById('photo-placeholder');
        img.src = ev.target.result;
        img.style.display = 'block';
        if (ph) ph.style.display = 'none';
    };
    reader.readAsDataURL(file);
});

// CV tab switch
function switchCvTab(tab) {
    document.getElementById('cv-link-panel').style.display = tab === 'link' ? 'block' : 'none';
    document.getElementById('cv-file-panel').style.display = tab === 'file' ? 'block' : 'none';
    document.getElementById('tab-link').classList.toggle('active', tab === 'link');
    document.getElementById('tab-file').classList.toggle('active', tab === 'file');
}

// Pré-visualização rápida ao digitar
function liveSync(inputName, previewId) {
    const el = document.querySelector('[name="' + inputName + '"]');
    const pv = document.getElementById(previewId);
    if (!el || !pv) return;
    el.addEventListener('input', function() {
        pv.textContent = this.value || '—';
    });
}
liveSync('owner_name',  'prev-name');
liveSync('owner_title', 'prev-title');
liveSync('owner_email', 'prev-email');
</script>
