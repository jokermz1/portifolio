<?php $pageTitle = 'Novo Projeto — Admin'; ?>
<div class="page-header">
    <h1 class="page-title"><?= t('Novo Projeto') ?></h1>
    <a href="<?= BASE_URL ?>/admin/portfolio" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i><?= t('Voltar') ?>
    </a>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/portfolio/create" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">
        <!-- ── Coluna principal ── -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-folder2 me-2" style="color:var(--accent);"></i><?= t('Informações do Projeto') ?></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><?= t('Título') ?> *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"><?= t('Categoria') ?></label>
                            <input type="text" name="category" list="cat-list" class="form-control" placeholder="ex: Web Design">
                            <datalist id="cat-list">
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"><?= t('Cliente') ?></label>
                            <input type="text" name="client" class="form-control" placeholder="ex: Hachicko Tee">
                        </div>
                        <div class="col-12">
                            <label class="form-label"><?= t('Descrição curta') ?></label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label"><?= t('Conteúdo') ?></label>
                            <textarea name="content" class="form-control" rows="6"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- URLs -->
            <?php $existingLinks = []; View::partial('links-manager', ['existingLinks' => $existingLinks]); ?>

            <!-- Galeria de imagens -->
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-images me-2" style="color:var(--accent);"></i><?= t('Galeria de Imagens') ?></div>
                <div class="card-body" id="upload-zone">
                    <label class="form-label"><?= t('Imagem de Capa') ?></label>
                    <input type="file" name="image" class="form-control mb-2" accept="image/*" id="cover-input">
                    <div id="cover-preview" class="mb-3" style="display:none;">
                        <img id="cover-img" src="" alt="" style="height:120px; border-radius:8px; object-fit:cover; border:1px solid rgba(183,117,255,.2);">
                    </div>

                    <label class="form-label"><?= t('Imagens Adicionais') ?> <small style="color:var(--text-faint); font-weight:400;"><?= t('(várias · escreve um título por imagem)') ?></small></label>
                    <input type="file" name="images[]" class="form-control mb-1" accept="image/*" multiple id="gallery-input">
                    <div id="gallery-preview" class="row g-3 mt-1"></div>
                </div>
            </div>
        </div>

        <!-- ── Coluna lateral ── -->
        <div class="col-lg-4">
            <div class="card mb-4" style="position:sticky; top:20px;">
                <div class="card-header"><i class="bi bi-gear me-2" style="color:var(--accent);"></i><?= t('Publicação') ?></div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" checked>
                        <label class="form-check-label" for="is_published"><?= t('Publicado') ?></label>
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured">
                        <label class="form-check-label" for="is_featured"><?= t('Destacado na homepage') ?></label>
                    </div>
                    <div class="mb-4">
                        <label class="form-label"><?= t('Ordem') ?></label>
                        <input type="number" name="sort_order" min="0" value="0" class="form-control">
                        <small style="color:var(--text-faint); font-size:11px;">
                            <i class="bi bi-info-circle me-1"></i><?= t('0 = automático (por data). 1 = aparece primeiro, depois 2, 3…') ?>
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i><?= t('Criar Projeto') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
(function () {
    const coverInput   = document.getElementById('cover-input');
    const coverImg     = document.getElementById('cover-img');
    const coverPreview = document.getElementById('cover-preview');
    const galleryInput = document.getElementById('gallery-input');
    const galleryWrap  = document.getElementById('gallery-preview');

    // —— Capa ——————————————————————————————————————
    // A colagem é tratada pela "zona de colar" geral do admin (admin.js),
    // que define o ficheiro e dispara o evento change.
    coverInput.addEventListener('change', function () {
        if (!this.files[0]) return;
        coverImg.src = URL.createObjectURL(this.files[0]);
        coverPreview.style.display = 'block';
    });

    // —— Galeria (input.files é a fonte de verdade) ————————————
    function renderGallery() {
        // preserva as legendas já escritas, associadas a cada ficheiro
        const prev = {};
        galleryWrap.querySelectorAll('[data-sig]').forEach(function (el) {
            const cap = el.querySelector('input[name="image_captions[]"]');
            prev[el.dataset.sig] = cap ? cap.value : '';
        });

        galleryWrap.innerHTML = '';
        Array.from(galleryInput.files).forEach(function (file, idx) {
            const sig = file.name + '_' + file.size;

            const col = document.createElement('div');
            col.className = 'col-6 col-md-4';
            col.dataset.sig = sig;

            const box = document.createElement('div');
            box.className = 'position-relative';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.cssText = 'height:110px; width:100%; object-fit:cover; border-radius:8px; border:1px solid rgba(183,117,255,.2);';

            const del = document.createElement('button');
            del.type = 'button';
            del.innerHTML = '×';
            del.style.cssText = 'position:absolute;top:-6px;right:-6px;width:22px;height:22px;border-radius:50%;background:#f87171;border:none;color:#fff;font-size:12px;cursor:pointer;display:flex;align-items:center;justify-content:center;padding:0;line-height:1;';
            del.onclick = function () {
                const dt = new DataTransfer();
                Array.from(galleryInput.files).forEach(function (f, i) { if (i !== idx) dt.items.add(f); });
                galleryInput.files = dt.files;
                renderGallery();
            };

            const cap = document.createElement('input');
            cap.type = 'text';
            cap.name = 'image_captions[]';
            cap.className = 'form-control form-control-sm mt-2';
            cap.placeholder = 'Título da imagem';
            cap.value = prev[sig] || '';

            box.appendChild(img);
            box.appendChild(del);
            col.appendChild(box);
            col.appendChild(cap);
            galleryWrap.appendChild(col);
        });
    }

    galleryInput.addEventListener('change', renderGallery);
})();
</script>
