<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <script>
      (function () {
        try {
          var t = localStorage.getItem('site-theme');
          if (t === 'light' || t === 'dark') document.documentElement.setAttribute('data-theme', t);
        } catch (e) {}
      })();
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin — ' . APP_NAME) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin.css?v=<?= @filemtime(ROOT_PATH . '/public/css/admin.css') ?>">
    <style>
      /* Regras críticas do toggle (sempre frescas, imunes a cache) */
      .topbar-toggle-theme{background:none;border:1px solid rgba(255,255,255,.14);color:#7a7a9a;border-radius:8px;padding:5px 9px;cursor:pointer;line-height:1;transition:color .18s,border-color .18s;}
      .topbar-toggle-theme:hover{color:#B775FF;border-color:#B775FF;}
      .theme-icon-light{display:none;}
      [data-theme="light"] .theme-icon-dark{display:none;}
      [data-theme="light"] .theme-icon-light{display:inline-block;}
    </style>
</head>
<body class="admin-body">

<div class="d-flex" id="admin-wrapper">
    <?php View::inc('admin/sidebar') ?>

    <div class="flex-grow-1 d-flex flex-column" id="admin-content">
        <?php View::inc('admin/topbar') ?>

        <main class="flex-grow-1">
            <?php if (isset($flash) && $flash): ?>
                <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?= $content ?>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/js/admin.js?v=<?= @filemtime(ROOT_PATH . '/public/js/admin.js') ?>"></script>
<script>
  (function () {
    var btn = document.getElementById('adminThemeToggle');
    if (!btn) return;
    btn.addEventListener('click', function () {
      var cur  = document.documentElement.getAttribute('data-theme');
      var next = cur === 'light' ? 'dark' : 'light';
      document.documentElement.setAttribute('data-theme', next);
      try { localStorage.setItem('site-theme', next); } catch (e) {}
    });
  })();
</script>
</body>
</html>
