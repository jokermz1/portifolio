<?php $pageTitle = 'Novo Projeto — Admin'; ?>
<div class="page-header">
    <h1 class="page-title">Novo Projeto</h1>
    <a href="<?= BASE_URL ?>/admin/portfolio" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/portfolio/create" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">
        <!-- ── Coluna principal ── -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-folder2 me-2" style="color:var(--accent);"></i>Informações do Projeto</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Título *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Categoria</label>
                            <input type="text" name="category" list="cat-list" class="form-control" placeholder="ex: Web Design">
                            <datalist id="cat-list">
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cliente</label>
                            <input type="text" name="client" class="form-control" placeholder="ex: Hachicko Tee">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descrição curta</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Conteúdo</label>
                            <textarea name="content" class="form-control" rows="6"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- URLs -->
            <?php $existingLinks = []; View::partial('links-manager', ['existingLinks' => $existingLinks]); ?>

            <!-- Galeria de imagens -->
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-images me-2" style="color:var(--accent);"></i>Galeria de Imagens</div>
                <div class="card-body" id="upload-zone">
                    <p style="font-size:12px; color:var(--text-muted); margin-bottom:12px;">
                        Podes <strong>escolher um ficheiro</strong> ou <strong>colar (Ctrl+V)</strong> uma imagem copiada — ideal para prints de ecrã.
                    </p>

                    <label class="form-label">Imagem de Capa</label>
                    <div class="input-group mb-2">
                        <input type="file" name="image" class="form-control" accept="image/*" id="cover-input">
                        <button type="button" class="btn btn-outline-secondary" id="cover-paste">
                            <i class="bi bi-clipboard me-1"></i>Colar
                        </button>
                    </div>
                    <div id="cover-preview" class="mb-3" style="display:none;">
                        <img id="cover-img" src="" alt="" style="height:120px; border-radius:8px; object-fit:cover; border:1px solid rgba(183,117,255,.2);">
                    </div>

                    <label class="form-label">Imagens Adicionais <small style="color:var(--text-faint); font-weight:400;">(várias · escreve um título por imagem)</small></label>
                    <div class="input-group mb-1">
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple id="gallery-input">
                        <button type="button" class="btn btn-outline-secondary" id="gallery-paste">
                            <i class="bi bi-clipboard me-1"></i>Colar
                        </button>
                    </div>
                    <small style="color:var(--text-faint); font-size:11px;">
                        <i class="bi bi-info-circle me-1"></i>Copia uma imagem e clica em <strong>Colar</strong> (ou Ctrl+V). As imagens vão-se acumulando.
                    </small>
                    <div id="gallery-preview" class="row g-3 mt-1"></div>
                </div>
            </div>
        </div>

        <!-- ── Coluna lateral ── -->
        <div class="col-lg-4">
            <div class="card mb-4" style="position:sticky; top:20px;">
                <div class="card-header"><i class="bi bi-gear me-2" style="color:var(--accent);"></i>Publicação</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" checked>
                        <label class="form-check-label" for="is_published">Publicado</label>
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured">
                        <label class="form-check-label" for="is_featured">Destacado na homepage</label>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Ordem</label>
                        <input type="number" name="sort_order" min="0" value="0" class="form-control">
                        <small style="color:var(--text-faint); font-size:11px;">
                            <i class="bi bi-info-circle me-1"></i>0 = automático (por data). 1 = aparece primeiro, depois 2, 3…
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i>Criar Projeto
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

    let galleryFiles = [];          // acumula os File da galeria
    let pasteTarget  = 'gallery';   // para onde vai o Ctrl+V (muda ao focar a capa)

    // —— Helpers ————————————————————————————————
    function renameBlob(blob) {
        let ext = (blob.type.split('/')[1] || 'png').toLowerCase();
        if (ext === 'jpeg') ext = 'jpg';
        const stamp = Date.now() + '-' + Math.random().toString(36).slice(2, 7);
        return new File([blob], 'colado-' + stamp + '.' + ext, { type: blob.type });
    }

    function syncGalleryInput() {
        const dt = new DataTransfer();
        galleryFiles.forEach(f => dt.items.add(f));
        galleryInput.files = dt.files;
    }

    function renderGallery() {
        // preserva os títulos já escritos (pela ordem)
        const caps = Array.from(galleryWrap.querySelectorAll('input[name="image_captions[]"]')).map(i => i.value);
        galleryWrap.innerHTML = '';
        galleryFiles.forEach((file, idx) => {
            const col = document.createElement('div');
            col.className = 'col-6 col-md-4';

            const box = document.createElement('div');
            box.className = 'position-relative';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.cssText = 'height:110px; width:100%; object-fit:cover; border-radius:8px; border:1px solid rgba(183,117,255,.2);';

            const del = document.createElement('button');
            del.type = 'button';
            del.innerHTML = '×';
            del.style.cssText = 'position:absolute;top:-6px;right:-6px;width:22px;height:22px;border-radius:50%;background:#f87171;border:none;color:#fff;font-size:12px;cursor:pointer;display:flex;align-items:center;justify-content:center;padding:0;line-height:1;';
            del.onclick = () => { galleryFiles.splice(idx, 1); syncGalleryInput(); renderGallery(); };

            const cap = document.createElement('input');
            cap.type = 'text';
            cap.name = 'image_captions[]';
            cap.className = 'form-control form-control-sm mt-2';
            cap.placeholder = 'Título da imagem';
            cap.value = caps[idx] || '';

            box.appendChild(img);
            box.appendChild(del);
            col.appendChild(box);
            col.appendChild(cap);
            galleryWrap.appendChild(col);
        });
        syncGalleryInput();
    }

    function addGalleryFiles(files) {
        files.forEach(f => galleryFiles.push(f));
        renderGallery();
    }

    function setCover(file) {
        const dt = new DataTransfer();
        dt.items.add(file);
        coverInput.files = dt.files;
        coverImg.src = URL.createObjectURL(file);
        coverPreview.style.display = 'block';
    }

    async function readClipboardImage() {
        const items = await navigator.clipboard.read();
        for (const item of items) {
            const type = item.types.find(t => t.startsWith('image/'));
            if (type) return renameBlob(await item.getType(type));
        }
        return null;
    }

    // —— Capa ————————————————————————————————————
    coverInput.addEventListener('focus', () => pasteTarget = 'cover');
    coverInput.addEventListener('change', function () {
        if (this.files[0]) setCover(this.files[0]);
    });
    document.getElementById('cover-paste').addEventListener('click', async () => {
        pasteTarget = 'cover';
        try {
            const f = await readClipboardImage();
            if (f) setCover(f); else alert('Não há nenhuma imagem copiada. Copia uma imagem primeiro.');
        } catch {
            alert('O navegador bloqueou o acesso à área de transferência. Usa Ctrl+V em vez do botão.');
        }
    });

    // —— Galeria ——————————————————————————————————
    galleryInput.addEventListener('focus', () => pasteTarget = 'gallery');
    galleryInput.addEventListener('change', function () {
        addGalleryFiles(Array.from(this.files));
    });
    document.getElementById('gallery-paste').addEventListener('click', async () => {
        pasteTarget = 'gallery';
        try {
            const f = await readClipboardImage();
            if (f) addGalleryFiles([f]); else alert('Não há nenhuma imagem copiada. Copia uma imagem primeiro.');
        } catch {
            alert('O navegador bloqueou o acesso à área de transferência. Usa Ctrl+V em vez do botão.');
        }
    });

    // —— Ctrl+V em qualquer ponto ————————————————————
    document.addEventListener('paste', function (e) {
        const files = [];
        for (const item of (e.clipboardData ? e.clipboardData.items : [])) {
            if (item.type && item.type.startsWith('image/')) {
                const blob = item.getAsFile();
                if (blob) files.push(renameBlob(blob));
            }
        }
        if (!files.length) return;
        e.preventDefault();
        if (pasteTarget === 'cover') setCover(files[0]);
        else addGalleryFiles(files);
    });
})();
</script>
