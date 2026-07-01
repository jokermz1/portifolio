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
    <title>Admin Login — <?= APP_NAME ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin.css?v=<?= @filemtime(ROOT_PATH . '/public/css/admin.css') ?>">
    <style>
      /* Regras críticas do toggle (sempre frescas, imunes a cache) */
      .admin-login-theme-toggle{position:fixed;top:20px;right:20px;z-index:10;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.14);color:#7a7a9a;border-radius:8px;padding:7px 11px;cursor:pointer;line-height:1;transition:color .18s,border-color .18s;}
      .admin-login-theme-toggle:hover{color:#B775FF;border-color:#B775FF;}
      .theme-icon-light{display:none;}
      [data-theme="light"] .theme-icon-dark{display:none;}
      [data-theme="light"] .theme-icon-light{display:inline-block;}
    </style>
</head>
<body class="admin-login-body">
    <button type="button" id="adminThemeToggle" class="admin-login-theme-toggle"
            title="Alternar tema claro/escuro" aria-label="Alternar tema claro/escuro">
        <i class="bi bi-moon-stars-fill theme-icon-dark"></i>
        <i class="bi bi-sun-fill theme-icon-light"></i>
    </button>
    <?= $content ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
