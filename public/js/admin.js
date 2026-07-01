document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('admin-sidebar');

    if (toggle && sidebar) {
        toggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (sidebar.classList.contains('open') &&
                !sidebar.contains(e.target) &&
                !toggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    }
});

/* ── Colar imagens (Ctrl+V) em todos os campos de foto do admin ──── */
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[type="file"]').forEach(function (input) {
        var accept = (input.getAttribute('accept') || '').toLowerCase();
        if (accept.indexOf('image') === -1) return;   // apenas campos de foto (image/*)

        var zone = document.createElement('div');
        zone.className = 'paste-zone';
        zone.tabIndex = 0;
        zone.setAttribute('role', 'button');
        var defaultLabel = '<i class="bi bi-clipboard-plus"></i> Clique aqui e cole uma imagem (Ctrl+V)';
        zone.innerHTML = defaultLabel;
        input.insertAdjacentElement('afterend', zone);

        function setFile(file) {
            var dt = new DataTransfer();
            dt.items.add(file);
            if (input.multiple && input.files) {
                for (var i = 0; i < input.files.length; i++) dt.items.add(input.files[i]);
            }
            input.files = dt.files;
            input.dispatchEvent(new Event('change', { bubbles: true }));
            zone.classList.add('has-file');
            zone.innerHTML = '<i class="bi bi-check-circle"></i> Imagem colada: ' + file.name;
        }

        function onPaste(e) {
            var data = e.clipboardData || window.clipboardData;
            if (!data || !data.items) return;
            for (var i = 0; i < data.items.length; i++) {
                var it = data.items[i];
                if (it.kind === 'file' && it.type.indexOf('image/') === 0) {
                    var blob = it.getAsFile();
                    if (blob) {
                        var ext = (blob.type.split('/')[1] || 'png').replace('jpeg', 'jpg');
                        setFile(new File([blob], 'colado-' + Date.now() + '.' + ext, { type: blob.type }));
                    }
                    e.preventDefault();
                    return;
                }
            }
        }

        zone.addEventListener('click', function () { zone.focus(); });
        zone.addEventListener('paste', onPaste);
    });
});
